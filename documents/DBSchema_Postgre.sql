-- Tabelle: Benutzer
CREATE TABLE Benutzer (
    Nutzer_ID      SERIAL PRIMARY KEY,
    Username       VARCHAR(100) NOT NULL,
    E_Mail         VARCHAR(255) UNIQUE NOT NULL,
    Password_Hash  VARCHAR(255) NOT NULL,
    Created_at     TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Score_total    INT DEFAULT 0
);

-- Tabelle: Kategorie
CREATE TABLE Kategorie (
    Kategorie_ID   SERIAL PRIMARY KEY,
    Kategorie      VARCHAR(100) NOT NULL,
    Emoji          VARCHAR(10) NOT NULL,
    Created_by     INT REFERENCES Benutzer(Nutzer_ID) ON DELETE SET NULL,
    QuestionsNumber INT
);

-- Tabelle: Fragen
CREATE TABLE Fragen (
    Frage_ID       SERIAL PRIMARY KEY,
    Frage_Text     VARCHAR(1000) NOT NULL,
    Kategorie_ID   INT REFERENCES Kategorie(Kategorie_ID) ON DELETE SET NULL,
    Created_by     INT REFERENCES Benutzer(Nutzer_ID) ON DELETE SET NULL
);

-- Tabelle: Antworten
CREATE TABLE Antworten (
    Antwort_ID     SERIAL PRIMARY KEY,
    Frage_ID       INT REFERENCES Fragen(Frage_ID) ON DELETE CASCADE,
    Antworttext    VARCHAR(1000) NOT NULL,
    is_correct     BOOLEAN NOT NULL
);

-- Tabelle: Benutzer_Antworten
CREATE TABLE Benutzer_Antworten (
    Nutzerantwort_ID  SERIAL PRIMARY KEY,
    Nutzer_ID         INT REFERENCES Benutzer(Nutzer_ID) ON DELETE CASCADE,
    Frage_ID          INT REFERENCES Fragen(Frage_ID) ON DELETE CASCADE,
    Antwort_ID        INT REFERENCES Antworten(Antwort_ID) ON DELETE SET NULL,
    Answered_at       TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);

-- Tabelle: Score_Runde
CREATE TABLE Score_Runde (
    score_ID      SERIAL PRIMARY KEY,
    Nutzer_ID     INT REFERENCES Benutzer(Nutzer_ID) ON DELETE CASCADE,
    Score_Value   INT NOT NULL,
    score_date    TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);