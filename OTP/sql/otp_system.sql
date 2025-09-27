CREATE DATABASE IF NOT EXISTS otp_adm;
USE otp_adm;

CREATE TABLE IF NOT EXISTS otp_sessions (
    chat_id BIGINT PRIMARY KEY,
    otp INT NOT NULL,
    expires_at INT NOT NULL,
    session_key VARCHAR(64)
);

