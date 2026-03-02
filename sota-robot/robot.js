const axios = require("axios");
const puppeteer = require("puppeteer");

const API_BASE_URL = "http://duanmoi.local/api/tool";
const API_KEY = "SOTA_TOOL_SECRET_@2026";
const { authenticator } = require('otplib');

async function processOrder(order) {
  const browser = await puppeteer.launch({
    headless: false,
    defaultViewport: null,
    args: ["--start-maximized", "--lang=en-US"],
  });
  const page = await browser.newPage();

  try {
    console.log(`🚀 Robot đang tiến vào Facebook: ${order.account}`);
    await page.goto("https://www.facebook.com/", { waitUntil: "networkidle2" });

    // Xử lý bảng thông báo Cookies (nếu có)
    try {
      const cookieBtn =
        'button[data-testid="cookie-policy-manage-dialog-accept-button"]';
      await page.waitForSelector(cookieBtn, { timeout: 3000 });
      await page.click(cookieBtn);
    } catch (e) {}

    // Tìm và điền Email/Pass
    const emailSelector = 'input[name="email"], #email';
    await page.waitForSelector(emailSelector, { timeout: 10000 });
    await page.type(emailSelector, order.account, { delay: 100 });
    await page.type('input[name="pass"], #pass', order.password, {
      delay: 100,
    });

    console.log("✍️ Đã điền xong. Đang thực hiện đăng nhập...");

    await page.keyboard.press("Enter");

    // Đợi trang chuyển hướng sau khi đăng nhập (Tối đa 15 giây)
    console.log("⏳ Đang đợi Facebook phê duyệt đăng nhập...");
    await new Promise((r) => setTimeout(r, 10000));

    // Kiểm tra xem có bị bắt nhập mã 2FA không
    if (page.url().includes("checkpoint")) {
      console.log("🛡️ Tài khoản yêu cầu mã 2FA!");
      // Chỗ này sau này sẽ thêm code giải mã 2FA
    }

    await browser.close();
    return { status: "completed", new_password: "Pass_Moi_OK" };
  } catch (error) {
    await page.screenshot({ path: `robot_error_id_${order.id}.png` });
    console.error(`❌ Đơn #${order.id} thất bại. Lỗi: ${error.message}`);
    await browser.close();
    return { status: "failed", new_password: null };
  }
}

async function startRobot() {
  console.log("=== Robot SOTA Đang Chạy 24/7 ===");

  while (true) {
    try {
      const getRes = await axios.get(`${API_BASE_URL}/get_order.php`, {
        headers: { "X-API-KEY": API_KEY },
      });

      if (getRes.data.status === "success") {
        const order = getRes.data.data;
        console.log(`\n📦 Nhận đơn #${order.id}`);

        const result = await processOrder(order);

        await axios.post(
          `${API_BASE_URL}/update_order.php`,
          {
            id: order.id,
            status: result.status,
            new_password: result.new_password,
          },
          { headers: { "X-API-KEY": API_KEY } },
        );

        console.log(`✅ Đã chốt đơn #${order.id} trạng thái: ${result.status}`);
      } else {
        console.log("😴 Hết đơn rồi, nghỉ 30s...");
        await new Promise((r) => setTimeout(r, 30000));
      }
    } catch (e) {
      console.log("⚠️ Đợi Server phản hồi...");
      await new Promise((r) => setTimeout(r, 5000));
    }
  }
}

startRobot();
