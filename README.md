# 🔐 OWASP Top 10 – Interactive Vulnerabilities Learning Platform

Welcome to our interactive platform designed to **learn, exploit, and prevent** the most critical security vulnerabilities in modern web applications – inspired by the [OWASP Top 10](https://owasp.org/www-project-top-ten/).

> 💡 Built by passionate developers & cybersecurity enthusiasts to **educate through real-world simulations**.

---

## 🚀 Features

- 🎮 Hands-on vulnerability simulations
- 🌗 Built-in Dark Mode
- 🎨 Clean UI with Tailwind CSS
- 🔄 Realistic **vulnerable vs secure** code implementations
- 🧠 Detailed prevention techniques with interactive collapsible sections
- 📁 Structured project files per contributor
- ⚙️ Modular & extendable

---

## 🧩 Tech Stack

- **Frontend**: HTML, Tailwind CSS, JavaScript, jQuery  
- **Backend**: PHP  
- **Data**: JSON  
- **Fonts**: Lexend, Press Start 2P  
- **Extras**: GIFs, code blocks, animations  

---

## 📂 Project Structure

```
OWASP-Top10-Interactive/
├── index.html
├── Tailwind Files/
├── Kartavya/
├── Karan/
├── Malay/
├── Kavy/
├── assets/
│   └── fonts/, gifs/, icons/, screenshots/
└── README.md
```

---

## 🔟 OWASP Top 10 Modules

| #  | Vulnerability                              | Status     | Lead Developer |
|----|--------------------------------------------|------------|----------------|
| 1  | Broken Access Control                      | ✅ Completed | Kavy           |
| 2  | Cryptographic Failures                     | ✅ Completed | Malay          |
| 3  | Injection (SQLi)                           | ✅ Completed | Kavy           |
| 4  | Insecure Design                            | ✅ Completed | Kavy           |
| 5  | Security Misconfiguration                  | ✅ Completed | Karan          |
| 6  | Vulnerable & Outdated Components           | ✅ Completed | Kartavya       |
| 7  | Identification & Authentication Failures   | ✅ Completed | Malay          |
| 8  | Software & Data Integrity Failures         | ✅ Completed | Kartavya       |
| 9  | Security Logging & Monitoring Failures     | ✅ Completed | Karan          |
| 10 | Server-Side Request Forgery (SSRF)         | ✅ Completed | Kartavya       |

---

## 🖼️ Screenshots

| Vulnerable Page | Secure Page |
|-----------------|-------------|
| ![Vulnerable](assets/screenshots/sqli_vulnerable.png) | ![Secure](assets/screenshots/sqli_secure.png) |

---

## 🛠️ How to Run Locally

```bash
# Clone the repository
git clone https://github.com/your-username/OWASP-Top10-Interactive.git
cd OWASP-Top10-Interactive

# Start PHP server
php -S localhost:8000

# Open in browser
http://localhost:8000
```

---

## 🤝 Contributors

| Name      | Modules                              |
|-----------|--------------------------------------|
| **Kavy**      | Home Page, SQL Injection, Broken Access Control, Insecure Design |
| **Kartavya**  | Vulnerable Components, SSRF, Data Integrity Failures |
| **Karan**     | Security Misconfig, Logging & Monitoring Failures |
| **Malay**     | Cryptographic Failures, Auth Failures |

---

## 📢 Disclaimer

This project is **strictly for educational purposes**.  
Do **not** deploy vulnerable code to production environments.  
Always follow ethical hacking and responsible disclosure guidelines.

---

## 🌟 Show Some Love

If this project helped you learn, drop a ⭐ and share it with your peers!  
Let’s make web apps more secure, one exploit at a time 💻🔐
