# ระบบคำนวณ GPA

## การรันด้วย Docker

### วิธีที่ 1: ใช้ docker-compose (แนะนำ)

```bash
docker-compose up --build
```

จากนั้นเปิดเบราว์เซอร์ไปที่: http://localhost:8080

### วิธีที่ 2: ใช้ Docker โดยตรง

```bash
docker build -t gpa-calculator .
docker run -d -p 8080:80 -v $(pwd):/var/www/html gpa-calculator
```

จากนั้นเปิดเบราว์เซอร์ไปที่: http://localhost:8080

### หยุดการรัน

```bash
docker-compose down
```

หรือ

```bash
docker stop <container-id>
```
# 07-Assignment-4
