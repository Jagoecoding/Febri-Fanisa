import sys
from PyQt5.QtWidgets import QApplication, QWidget, QVBoxLayout, QHBoxLayout, QGridLayout, QLabel, QPushButton, QLineEdit, QCheckBox, QGroupBox, QSizePolicy
from PyQt5.QtGui import QFont
from PyQt5.QtCore import Qt

class SettingsWindow(QWidget):
    def __init__(self):
        super().__init__()

        self.setWindowTitle("JagoeCoding - Settings")
        self.setGeometry(100, 100, 900, 600)
        self.setStyleSheet("""
            QWidget {
                background-color: #1f1b32;
                color: white;
            }
            QPushButton {
                color: white;
                background-color: #5e60ce;
                border-radius: 10px;
                padding: 10px;
            }
            QGroupBox {
                background-color: #2b2548;
                border: 2px solid #5e60ce;
                border-radius: 10px;
                margin-top: 20px;
                font-size: 16px;
            }
            QLineEdit {
                background-color: #3e3761;
                border: 1px solid #5e60ce;
                border-radius: 5px;
                color: white;
                padding: 8px;
            }
            QLabel {
                font-size: 12px;
            }
            QCheckBox {
                font-size: 14px;
            }
        """)

        # Layout utama (Horizontal)
        main_layout = QHBoxLayout(self)

        # Panel Navigasi Kiri
        nav_layout = QVBoxLayout()
        nav_frame = QWidget()
        nav_frame.setLayout(nav_layout)

        logo_label = QLabel("<h1 style='color:#5e60ce;'>JagoeCoding</h1>")
        logo_label.setAlignment(Qt.AlignCenter)
        logo_label.setSizePolicy(QSizePolicy.Expanding, QSizePolicy.Fixed)
        nav_layout.addWidget(logo_label)

        buttons = ["Dashboard", "Course", "Leaderboard", "Profile", "Settings", "Help", "Log Out"]
        for button_text in buttons:
            btn = QPushButton(button_text)
            btn.setFixedHeight(40)
            nav_layout.addWidget(btn)

        nav_frame.setFixedWidth(200)
        main_layout.addWidget(nav_frame)

        # Panel Konten Kanan (Grid Layout)
        content_layout = QVBoxLayout()
        content_frame = QWidget()
        content_frame.setLayout(content_layout)

        # Security Section
        security_group = QGroupBox("Security")
        security_layout = QVBoxLayout()

        # Tambahkan elemen-elemen di dalam grup security
        current_password_label = QLabel("Current Password:")
        current_password_label.setFixedHeight(25)
        current_password_field = QLineEdit()
        current_password_field.setEchoMode(QLineEdit.Password)
        current_password_field.setFixedHeight(35)
        
        new_password_label = QLabel("New Password:")
        new_password_label.setFixedHeight(25)
        new_password_field = QLineEdit()
        new_password_field.setEchoMode(QLineEdit.Password)
        new_password_field.setFixedHeight(35)

        confirm_password_label = QLabel("Confirm Password:")
        confirm_password_label.setFixedHeight(25)
        confirm_password_field = QLineEdit()
        confirm_password_field.setEchoMode(QLineEdit.Password)
        confirm_password_field.setFixedHeight(35)

        face_recognition_label = QLabel("Enable Face Recognition:")
        face_recognition_label.setFixedHeight(25)

        face_status = QLabel("Inactive")
        face_status.setStyleSheet("color: red;")
        face_status.setFixedHeight(25)

        setup_button = QPushButton("Set Up Now")
        setup_button.setFixedHeight(35)
        
        save_security_btn = QPushButton("Save Change")
        save_security_btn.setFixedHeight(35)

        # Add widgets to the security layout
        security_layout.addWidget(current_password_label)
        security_layout.addWidget(current_password_field)
        security_layout.addWidget(new_password_label)
        security_layout.addWidget(new_password_field)
        security_layout.addWidget(confirm_password_label)
        security_layout.addWidget(confirm_password_field)
        security_layout.addWidget(face_recognition_label)
        security_layout.addWidget(face_status)
        security_layout.addWidget(setup_button)
        security_layout.addWidget(save_security_btn)

        security_group.setLayout(security_layout)
        content_layout.addWidget(security_group)

        # Notification Section
        notification_group = QGroupBox("Notification")
        notification_layout = QVBoxLayout()

        checkboxes = [
            "I want to know when a new challenge is available.",
            "I want to know when I complete a level.",
            "I want to know when my score is updated.",
            "I want to know when a new programming language is added.",
            "I want to know when new tips or guides are available for a specific level.",
            "I want to know when there is an update on my profile."
        ]

        for checkbox_text in checkboxes:
            checkbox = QCheckBox(checkbox_text)
            checkbox.setFixedHeight(25)
            notification_layout.addWidget(checkbox)

        save_notifications_btn = QPushButton("Save Change")
        notification_layout.addWidget(save_notifications_btn)

        notification_group.setLayout(notification_layout)
        content_layout.addWidget(notification_group)

        main_layout.addWidget(content_frame)
        self.setLayout(main_layout)

# Jalankan Aplikasi
if __name__ == '__main__':
    app = QApplication(sys.argv)
    window = SettingsWindow()
    window.show()
    sys.exit(app.exec_())
