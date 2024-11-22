import sys
import cv2
import mysql.connector
import os
from datetime import datetime

# Get username from command-line arguments
name = sys.argv[1] if len(sys.argv) > 1 else "Unknown"

# Set up the photo save directory
SAVE_DIR = "user_photos"
if not os.path.exists(SAVE_DIR):
    os.makedirs(SAVE_DIR)

# MySQL connection
conn = mysql.connector.connect(
    host="127.0.0.1",
    user="root",
    password="",
    database="face_recognition"
)
cursor = conn.cursor()

def register_user(name):
    # Initialize webcam and face detection
    cap = cv2.VideoCapture(0)
    face_cascade = cv2.CascadeClassifier(cv2.data.haarcascades + "haarcascade_frontalface_default.xml")
    
    print(f"Registering face for: {name}")
    
    while True:
        ret, frame = cap.read()
        if not ret:
            print("Failed to access camera.")
            break
        
        # Convert to grayscale for face detection
        gray = cv2.cvtColor(frame, cv2.COLOR_BGR2GRAY)
        faces = face_cascade.detectMultiScale(gray, scaleFactor=1.3, minNeighbors=5)
        
        # Draw rectangles around faces
        for (x, y, w, h) in faces:
            cv2.rectangle(frame, (x, y), (x + w, y + h), (255, 0, 0), 2)
        
        # Display the frame
        cv2.imshow("Face Registration", frame)
        
        # Wait for key press
        key = cv2.waitKey(1)
        if key == 27:  # ESC to cancel
            print("Registration canceled.")
            break
        elif key == 32:  # SPACE to save the photo
            if len(faces) == 0:
                print("No face detected. Try again.")
                continue
            
            # Capture the first detected face
            x, y, w, h = faces[0]
            face_image = frame[y:y+h, x:x+w]
            
            # Save the image
            file_name = f"{name}_{datetime.now().strftime('%Y%m%d%H%M%S')}.jpg"
            file_path = os.path.join(SAVE_DIR, file_name)
            cv2.imwrite(file_path, face_image)
            
            # Insert into MySQL database
            cursor.execute("INSERT INTO face_recognition (name, photo_path) VALUES (%s, %s)", (name, file_path))
            conn.commit()
            
            print(f"Photo saved as {file_name}.")
            break
    
    # Clean up
    cap.release()
    cv2.destroyAllWindows()

def main():
    print("=== Face Registration System ===")
    if not name:
        print("Name cannot be empty.")
        return
    
    register_user(name)

if __name__ == "__main__":
    main()
