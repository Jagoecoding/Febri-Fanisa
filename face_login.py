import cv2
import sqlite3
import os
import numpy as np
import webbrowser
from datetime import datetime

# Membuat/menghubungkan ke database SQLite
conn = sqlite3.connect("users.db")
cursor = conn.cursor()

def recognize_user():
    """Fungsi untuk login pengguna berdasarkan deteksi wajah."""
    # Inisialisasi webcam
    cap = cv2.VideoCapture(0)
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + "haarcascade_frontalface_default.xml")
    
    print("Arahkan wajah Anda ke kamera untuk login.")
    
    while True:
        ret, frame = cap.read()
        if not ret:
            print("Gagal mengakses kamera.")
            break
        
        # Konversi ke grayscale untuk deteksi wajah
        gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        faces = face_cascade.detectMultiScale(gray, scaleFactor=1.3, minNeighbors=5)
        
        # Gambar kotak di sekitar wajah
        for (x, y, w, h) in faces:
            cv2.rectangle(frame, (x, y), (x + w, y + h), (255, 0, 0), 2)
        
        # Tampilkan frame
        cv2.imshow("Face Login", frame)
        
        # Deteksi tombol keyboard
        key = cv2.waitKey(1)
        if key == 27:  # ESC untuk keluar
            print("Login dibatalkan.")
            break
        elif key == 32:  # SPACE untuk mencoba login
            if len(faces) == 0:
                print("Tidak ada wajah terdeteksi. Coba lagi.")
                continue
            
            # Ambil hanya wajah pertama yang terdeteksi
            x, y, w, h = faces[0]
            face_image = gray[y:y+h, x:x+w]
            
            # Simpan sementara gambar wajah untuk perbandingan
            temp_path = "temp_login_face.jpg"
            cv2.imwrite(temp_path, face_image)
            
            # Coba cocokkan wajah dengan database
            user = match_face(temp_path)
            
            # Hapus file sementara
            if os.path.exists(temp_path):
                os.remove(temp_path)
            
            if user:
                print(f"Login berhasil! Selamat datang, {user['name']}.")
                open_dashboard()  # Panggil fungsi untuk membuka dashboard
                break
            else:
                print("Wajah tidak dikenali. Coba lagi.")
    
    # Bersihkan dan tutup kamera
    cap.release()
    cv2.destroyAllWindows()

def match_face(temp_image_path):
    """Fungsi untuk mencocokkan wajah dengan yang ada di database."""
    # Baca gambar yang terdeteksi dari webcam
    temp_image = cv2.imread(temp_image_path, cv2.IMREAD_GRAYSCALE)
    temp_image = cv2.resize(temp_image, (100, 100))  # Ubah ukuran untuk konsistensi
    
    # Ambil data pengguna dari database
    cursor.execute("SELECT name, photo_path FROM users")
    users = cursor.fetchall()
    
    # List untuk menyimpan wajah dan label
    known_faces = []
    labels = []
    
    for label, user in enumerate(users):
        user_name, photo_path = user
        if not os.path.exists(photo_path):
            continue
        
        # Baca foto pengguna yang terdaftar
        registered_image = cv2.imread(photo_path, cv2.IMREAD_GRAYSCALE)
        registered_image = cv2.resize(registered_image, (100, 100))  # Ubah ukuran untuk konsistensi
        
        # Tambahkan gambar dan label ke list
        known_faces.append(registered_image)
        labels.append(label)  # Gunakan integer sebagai label
    
    if len(known_faces) == 0:
        return None
    
    # Membuat dan melatih recognizer LBPH
    recognizer = cv2.face.LBPHFaceRecognizer_create()
    recognizer.train(known_faces, np.array(labels))
    
    # Coba kenali wajah yang terdeteksi
    label, confidence = recognizer.predict(temp_image)
    
    if confidence < 100:  # Toleransi error
        cursor.execute("SELECT name FROM users WHERE rowid=?", (label + 1,))
        user = cursor.fetchone()
        if user:
            return {"name": user[0]}
    
    return None

def open_dashboard():
    """Fungsi untuk membuka halaman dashboard setelah login berhasil."""
    chrome_path = "C:/Program Files/Google/Chrome/Application/chrome.exe %s"
    try:
        webbrowser.get(chrome_path).open("http://jago-coding-face-recognation-main.test/dashboard.php")
    except Exception as e:
        print(f"Error membuka dashboard: {e}")

def main():
    print("=== Sistem Login Wajah ===")
    recognize_user()
    
if __name__ == "__main__":
    main()
