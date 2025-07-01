-- Tabelle: Benutzer
CREATE TABLE Benutzer (
    Nutzer_ID      INT AUTO_INCREMENT PRIMARY KEY,
    Username       VARCHAR(100) NOT NULL,
    E_Mail         VARCHAR(255) UNIQUE NOT NULL,
    Password_Hash  VARCHAR(255) NOT NULL,
    Created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Score_total    INT DEFAULT 0
);

-- Tabelle: Kategorie
CREATE TABLE Kategorie (
    Kategorie_ID   INT AUTO_INCREMENT PRIMARY KEY,
    Kategorie      VARCHAR(100) NOT NULL,
    Emoji          VARCHAR(10) NOT NULL,
    Created_by     INT,
    Field          VARCHAR(100),
    FOREIGN KEY (Created_by) REFERENCES Benutzer(Nutzer_ID) ON DELETE SET NULL
);

-- Tabelle: Fragen
CREATE TABLE Fragen (
    Frage_ID       INT AUTO_INCREMENT PRIMARY KEY,
    Frage_Text     VARCHAR(1000) NOT NULL,
    Kategorie_ID   INT,
    Created_by     INT,
    FOREIGN KEY (Kategorie_ID) REFERENCES Kategorie(Kategorie_ID) ON DELETE SET NULL,
    FOREIGN KEY (Created_by) REFERENCES Benutzer(Nutzer_ID) ON DELETE SET NULL
);

-- Tabelle: Antworten
CREATE TABLE Antworten (
    Antwort_ID     INT AUTO_INCREMENT PRIMARY KEY,
    Frage_ID       INT,
    Antworttext    VARCHAR(1000) NOT NULL,
    is_correct     BOOLEAN NOT NULL,
    FOREIGN KEY (Frage_ID) REFERENCES Fragen(Frage_ID) ON DELETE CASCADE
);

-- Tabelle: Benutzer_Antworten
CREATE TABLE Benutzer_Antworten (
    Nutzerantwort_ID  INT AUTO_INCREMENT PRIMARY KEY,
    Nutzer_ID         INT,
    Frage_ID          INT,
    Antwort_ID        INT,
    Answered_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Nutzer_ID) REFERENCES Benutzer(Nutzer_ID) ON DELETE CASCADE,
    FOREIGN KEY (Frage_ID) REFERENCES Fragen(Frage_ID) ON DELETE CASCADE,
    FOREIGN KEY (Antwort_ID) REFERENCES Antworten(Antwort_ID) ON DELETE SET NULL
);

-- Tabelle: Score_Runde
CREATE TABLE Score_Runde (
    score_ID      INT AUTO_INCREMENT PRIMARY KEY,
    Nutzer_ID     INT,
    Score_Value   INT NOT NULL,
    score_date    TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (Nutzer_ID) REFERENCES Benutzer(Nutzer_ID) ON DELETE CASCADE
);