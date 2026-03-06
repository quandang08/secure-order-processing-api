const axios = require("axios");
const puppeteer = require("puppeteer");
const fs = require("fs");
const FormData = require("form-data");
const path = require("path");
const express = require("express");
const app = express();
app.use(express.json());

const API_BASE_URL = "http://duanmoi.local/api/tool";
const API_KEY = "SOTA_TOOL_SECRET_@2026";

// Hàm phụ trợ để Robot gửi tin nhắn vào phòng chat
async function sendRobotMessage(ticketId, message, photoPath = null) {
  try {
    const form = new FormData();
    form.append("ticket_id", ticketId);
    form.append("sender_id", 0); // 0 là Robot/Hệ thống
    form.append("sender_role", "admin");
    form.append("message", `[ROBOT SOTA]: ${message}`);

    if (photoPath && fs.existsSync(photoPath)) {
      form.append("photo", fs.createReadStream(photoPath));
    }

    await axios.post(`${API_BASE_URL}/send_message.php`, form, {
      headers: {
        ...form.getHeaders(),
        "X-API-KEY": API_KEY,
      },
    });
    console.log("🤖 Robot đã gửi báo cáo vào phòng chat.");
  } catch (e) {
    console.error("❌ Robot không thể gửi tin nhắn:", e.message);
  }
}

// Cổng tiếp nhận lệnh từ create_ticket.php
app.post("/trigger-robot", async (req, res) => {
  const { ticket_id, order_id, reason } = req.body;
  res.send({ status: "Robot is working" }); // Phản hồi ngay cho PHP để khách không phải đợi

  console.log(
    `\n🕵️ Robot nhận lệnh kiểm tra đơn #${order_id} (Ticket #${ticket_id})`,
  );

  // Lấy lại thông tin acc từ đơn hàng để kiểm tra
  try {
    const orderRes = await axios.get(
      `${API_BASE_URL}/get_order_by_id.php?id=${order_id}`,
      {
        headers: { "X-API-KEY": API_KEY },
      },
    );
    const order = orderRes.data.data;

    // Tiến hành kiểm tra bằng Puppeteer
    const result = await processOrder(order, ticket_id);

    if (result.status === "failed") {
      await sendRobotMessage(
        ticket_id,
        `Phát hiện lỗi: ${result.error}. Xem ảnh chụp màn hình bên dưới.`,
        result.screenshot,
      );
    } else {
      await sendRobotMessage(
        ticket_id,
        "Kết quả kiểm tra: Đăng nhập thành công. Tài khoản vẫn hoạt động bình thường.",
      );
    }
  } catch (e) {
    console.error("Lỗi thực thi Robot:", e.message);
  }
});

async function processOrder(order, ticket_id = null) {
  const browser = await puppeteer.launch({ headless: true });
  const page = await browser.newPage();
  const screenshotName = `ticket_${ticket_id}_error.png`;

  try {
    await page.goto("https://www.facebook.com/", { waitUntil: "networkidle2" });
    await page.type('input[name="email"]', order.account);
    await page.type('input[name="pass"]', order.password);
    await page.keyboard.press("Enter");

    // Đợi trang tải sau khi nhấn Enter
    await new Promise((r) => setTimeout(r, 10000));

    const pageContent = await page.content();
    const currentUrl = page.url();

    // Kiểm tra Checkpoint
    if (
      currentUrl.includes("checkpoint") ||
      pageContent.includes("checkpoint")
    ) {
      throw new Error("Bị chặn bởi Checkpoint/2FA");
    }

    // Kiểm tra sai mật khẩu
    const loginError = await page.$('div[role="alert"]');
    if (loginError) {
      throw new Error("Sai mật khẩu hoặc tài khoản bị vô hiệu hóa");
    }

    await browser.close();
    return { status: "success" };
  } catch (error) {
    // Chụp ảnh màn hình khi có bất kỳ lỗi nào xảy ra
    await page.screenshot({ path: screenshotName });
    await browser.close();
    return {
      status: "failed",
      error: error.message,
      screenshot: screenshotName,
    };
  }
}

app.listen(3000, () =>
  console.log("🚀 Webhook Robot đang lắng nghe tại port 3000"),
);
