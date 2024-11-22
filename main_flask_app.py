from flask import Flask, request, jsonify
from flask_cors import CORS  # Mengimpor CORS
import numpy as np
import cv2
import base64
from deepface import DeepFace
import os

app = Flask(__name__)

# Aktifkan CORS untuk aplikasi Flask
CORS(app)  # Mengizinkan semua domain untuk mengakses API ini

# Membuat direktori untuk menyimpan hasil crop
os.makedirs("cropped_faces", exist_ok=True)

# Fungsi untuk menghitung jarak antara dua vektor embedding
def calculate_distance(embedding1, embedding2):
    embedding1_vector = np.array(embedding1[0]['embedding'])
    embedding2_vector = np.array(embedding2[0]['embedding'])
    return np.linalg.norm(embedding1_vector - embedding2_vector)

# Fungsi untuk menyimpan wajah yang terdeteksi
def save_cropped_face(image, filename):
    # Deteksi wajah dan crop menggunakan DeepFace
    faces = DeepFace.extract_faces(image, detector_backend="opencv", enforce_detection=False)
    if faces:
        detected_face = faces[0]["face"]
        face_image = (detected_face * 255).astype(np.uint8)  # Ubah ke format 8-bit
        face_image_bgr = cv2.cvtColor(face_image, cv2.COLOR_RGB2BGR)
        cv2.imwrite(f"cropped_faces/{filename}.jpg", face_image_bgr)
    else:
        print(f"Tidak ada wajah yang terdeteksi pada {filename}")

@app.route('/authenticate', methods=['POST'])
# Update fungsi authenticate() di Flask
def authenticate():
    data = request.json
    image1_base64 = data['image1']
    image2_base64 = data['image2']

    # Decode gambar dari base64
    image1_data = base64.b64decode(image1_base64)
    image2_data = base64.b64decode(image2_base64)
    image1 = np.frombuffer(image1_data, np.uint8)
    image2 = np.frombuffer(image2_data, np.uint8)
    image1 = cv2.imdecode(image1, cv2.IMREAD_COLOR)
    image2 = cv2.imdecode(image2, cv2.IMREAD_COLOR)

    # Ekstraksi embedding wajah menggunakan DeepFace
    try:
        embedding1 = DeepFace.represent(image1, model_name="Facenet")
        embedding2 = DeepFace.represent(image2, model_name="Facenet")
    except ValueError:
        return jsonify({"error": "Tidak ada wajah yang terdeteksi"}), 400

    # Hitung jarak antara kedua embedding
    distance = calculate_distance(embedding1, embedding2)
    
    # Tentukan threshold untuk mencocokkan wajah
    threshold = 10.5  # Sesuaikan threshold jika diperlukan
    if distance < threshold:
        return jsonify({"status": "sukses", "message": "Autentikasi berhasil"})
    else:
        return jsonify({"status": "gagal", "message": "Autentikasi gagal"})


if __name__ == '__main__':
    app.run(host='127.0.0.1', port=5000)
