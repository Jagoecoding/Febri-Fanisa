import cv2
import base64
import requests
import numpy as np
import webbrowser
import time  # Tambahkan untuk pengaturan delay

# URL API untuk autentikasi
AUTH_API_URL = "http://127.0.0.1:5000/authenticate"

# Fungsi untuk menangkap gambar dari kamera
def capture_image():
    cap = cv2.VideoCapture(0)  # Buka kamera default (0)
    if not cap.isOpened():
        print("Error: Kamera tidak dapat dibuka.")
        return None

    while True:
        ret, frame = cap.read()
        if not ret:
            print("Error: Gagal menangkap gambar.")
            break
        
        cv2.imshow("Capture Image", frame)  # Tampilkan gambar secara real-time

        # Tunggu hingga wajah terdeteksi
        if cv2.waitKey(1) & 0xFF == ord('q'):  # Tekan 'q' untuk keluar atau deteksi wajah
            break

    cap.release()
    cv2.destroyAllWindows()

    # Simpan gambar yang diambil
    cv2.imwrite("captured_image.jpg", frame)
    print("Gambar telah disimpan sebagai 'captured_image.jpg'")
    
    return frame

# Fungsi untuk mengonversi gambar menjadi format base64
def image_to_base64(image):
    _, buffer = cv2.imencode('.jpg', image)
    image_base64 = base64.b64encode(buffer).decode('utf-8')
    return image_base64

# Fungsi untuk autentikasi gambar
def authenticate_image(captured_image):
    # Encode gambar yang ditangkap ke base64
    captured_image_base64 = image_to_base64(captured_image)
    
    # Muat gambar referensi
    try:
        with open("referensi.jpg", "rb") as ref_file:
            reference_image_base64 = base64.b64encode(ref_file.read()).decode('utf-8')
    except FileNotFoundError:
        print("Error: Gambar referensi tidak ditemukan.")
        return

    # Kirim gambar ke API Flask untuk autentikasi
    data = {
        "image1": captured_image_base64,  # Gambar yang ditangkap
        "image2": reference_image_base64   # Gambar referensi
    }
    
    response = requests.post(AUTH_API_URL, json=data)
    
    if response.status_code == 200:
        result = response.json()
        if result["status"] == "sukses":
            print("Login Berhasil!")
            open_dashboard()  # Buka halaman dashboard jika login berhasil
        else:
            print("Login Gagal. Wajah tidak cocok.")
    else:
        print("Terjadi error saat autentikasi:", response.json().get("error", "Error tidak diketahui"))

# Fungsi untuk membuka halaman dashboard setelah autentikasi berhasil
def open_dashboard():
    # Buka halaman dashboard.html di browser default
    webbrowser.open("http://jago-coding-face-recognation-main.test/dashboard.php")  # Buka halaman dashboard di browser
    
if __name__ == "__main__":
    print("Silakan posisi diri di depan kamera...")
    captured_image = capture_image()  # Tangkap gambar
    
    if captured_image is not None:
        authenticate_image(captured_image)  # Autentikasi gambar yang ditangkap
