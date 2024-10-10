

CREATE TABLE results (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100),
    score INT,
    total_questions INT,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
