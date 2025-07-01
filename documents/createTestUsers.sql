-- Create 3 test users with hashed passwords
INSERT INTO Benutzer (Username, E_Mail, Password_Hash, Score_total) VALUES 
('Anna Hoffer', 'anna@test.com', '$2y$10$/RHU7g6s3rL1Sw2R/aVgmOIM.0xg9ctlIvE/WnzejQZJGySDTyohW', 0),
('Jens Kowalski', 'jens@test.com', '$2y$10$/RHU7g6s3rL1Sw2R/aVgmOIM.0xg9ctlIvE/WnzejQZJGySDTyohW', 0),
('Jorge Pereira', 'jorge@test.com', '$2y$10$/RHU7g6s3rL1Sw2R/aVgmOIM.0xg9ctlIvE/WnzejQZJGySDTyohW', 0);

-- All passwords are: password123