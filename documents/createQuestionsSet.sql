-- University Level Quiz Data
-- Sequential inserts to avoid subquery errors

-- Insert university-level categories
INSERT INTO Kategorie (Kategorie, Created_by, Emoji, QuestionsNumber) VALUES 
('Höhere Mathematik', 1, '∫', 5),
('Theoretische Physik', 1, '⚛️', 5),
('Organische Chemie', 1, '🧪', 5),
('Informatik', 1, '💻', 5),
('Philosophie', 1, '🤔', 5),
('Mikroökonomie', 1, '📈', 5),
('Molekularbiologie', 1, '🧬', 5),
('Europäische Geschichte', 1, '🏛️', 5),
('Literaturwissenschaft', 1, '📖', 5),
('Kognitionspsychologie', 1, '🧠', 5);

-- Set variables for category IDs
SET @math_id = LAST_INSERT_ID();
SET @physics_id = @math_id + 1;
SET @chemistry_id = @math_id + 2;
SET @cs_id = @math_id + 3;
SET @philosophy_id = @math_id + 4;
SET @economics_id = @math_id + 5;
SET @biology_id = @math_id + 6;
SET @history_id = @math_id + 7;
SET @literature_id = @math_id + 8;
SET @psychology_id = @math_id + 9;

-- Höhere Mathematik Questions and Answers
INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was ist die Ableitung von ln(x²)?', @math_id, 1);
SET @q1 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q1, '1/x', 0),
(@q1, '2/x', 1),
(@q1, '2x', 0),
(@q1, 'x²', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche Aussage über konvergente Reihen ist korrekt?', @math_id, 1);
SET @q2 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q2, 'Jede monotone Reihe konvergiert', 0),
(@q2, 'Absolute Konvergenz impliziert Konvergenz', 1),
(@q2, 'Konvergenz impliziert absolute Konvergenz', 0),
(@q2, 'Alle Reihen mit positiven Gliedern konvergieren', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was beschreibt der Satz von Gauß-Green?', @math_id, 1);
SET @q3 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q3, 'Integration über geschlossene Kurven', 0),
(@q3, 'Beziehung zwischen Linien- und Flächenintegral', 1),
(@q3, 'Ableitung zusammengesetzter Funktionen', 0),
(@q3, 'Konvergenz von Fourier-Reihen', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche Eigenschaft hat eine orthogonale Matrix?', @math_id, 1);
SET @q4 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q4, 'Determinante ist immer 1', 0),
(@q4, 'A^T × A = I', 1),
(@q4, 'Alle Eigenwerte sind positiv', 0),
(@q4, 'Matrix ist immer symmetrisch', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was ist eine charakteristische Eigenschaft eines Banach-Raums?', @math_id, 1);
SET @q5 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q5, 'Endliche Dimension', 0),
(@q5, 'Vollständigkeit bezüglich der Norm', 1),
(@q5, 'Existenz eines Skalarprodukts', 0),
(@q5, 'Kompaktheit', 0);

-- Theoretische Physik Questions and Answers
INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was beschreibt die Schrödinger-Gleichung?', @physics_id, 1);
SET @q6 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q6, 'Klassische Teilchenbahnen', 0),
(@q6, 'Zeitliche Entwicklung der Wellenfunktion', 1),
(@q6, 'Elektrodynamische Felder', 0),
(@q6, 'Gravitationswellen', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welches Prinzip liegt der speziellen Relativitätstheorie zugrunde?', @physics_id, 1);
SET @q7 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q7, 'Äquivalenzprinzip', 0),
(@q7, 'Konstanz der Lichtgeschwindigkeit', 1),
(@q7, 'Unschärferelation', 0),
(@q7, 'Pauli-Prinzip', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was besagt das Noether-Theorem?', @physics_id, 1);
SET @q8 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q8, 'Energie ist immer erhalten', 0),
(@q8, 'Symmetrien führen zu Erhaltungsgrößen', 1),
(@q8, 'Teilchen haben Wellencharakter', 0),
(@q8, 'Raum und Zeit sind gekrümmt', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche Größe ist in der Quantenmechanik grundsätzlich unscharf?', @physics_id, 1);
SET @q9 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q9, 'Energie eines gebundenen Zustands', 0),
(@q9, 'Gleichzeitige Messung von Ort und Impuls', 1),
(@q9, 'Elektronenladung', 0),
(@q9, 'Lichtgeschwindigkeit', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was charakterisiert einen Bose-Einstein-Kondensatzustand?', @physics_id, 1);
SET @q10 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q10, 'Hohe Temperatur und Druck', 0),
(@q10, 'Teilchen im gleichen Quantenzustand', 1),
(@q10, 'Supraleitfähigkeit', 0),
(@q10, 'Kernfusion', 0);

-- Organische Chemie Questions and Answers
INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welcher Mechanismus liegt der SN2-Reaktion zugrunde?', @chemistry_id, 1);
SET @q11 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q11, 'Zweistufiger Mechanismus mit Carbokation', 0),
(@q11, 'Einstufiger Mechanismus mit Inversion', 1),
(@q11, 'Radikalische Substitution', 0),
(@q11, 'Elektrophile Addition', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was charakterisiert aromatische Verbindungen nach Hückel?', @chemistry_id, 1);
SET @q12 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q12, 'Gesättigte Ringverbindungen', 0),
(@q12, '4n+2 π-Elektronen im planaren Ring', 1),
(@q12, 'Hohe Reaktivität', 0),
(@q12, 'Ausschließlich Sechsringe', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welches Reagens wird für die Grignard-Reaktion benötigt?', @chemistry_id, 1);
SET @q13 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q13, 'Palladiumkatalysator', 0),
(@q13, 'Alkylmagnesiumhalogenid', 1),
(@q13, 'Lithiumaluminiumhydrid', 0),
(@q13, 'Natriumborhydrid', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was beschreibt die Markownikow-Regel?', @chemistry_id, 1);
SET @q14 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q14, 'Stabilität von Carbokationen', 0),
(@q14, 'Regioselektivität bei Alkenen-Addition', 1),
(@q14, 'Stereochemie von Substitutionen', 0),
(@q14, 'Aromatizität von Verbindungen', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche Konfiguration liegt bei (R)-2-Butanol vor?', @chemistry_id, 1);
SET @q15 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q15, 'OH-Gruppe zeigt nach links im Fischer-Projektion', 0),
(@q15, 'Rechtsdrehung des polarisierten Lichts', 1),
(@q15, 'Meso-Verbindung', 0),
(@q15, 'Racemisches Gemisch', 0);

-- Informatik Questions and Answers
INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was ist die Zeitkomplexität von QuickSort im worst-case?', @cs_id, 1);
SET @q16 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q16, 'O(n log n)', 0),
(@q16, 'O(n²)', 1),
(@q16, 'O(n)', 0),
(@q16, 'O(log n)', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche Datenstruktur verwendet Dijkstras Algorithmus?', @cs_id, 1);
SET @q17 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q17, 'Stack', 0),
(@q17, 'Priority Queue (Min-Heap)', 1),
(@q17, 'Hash Table', 0),
(@q17, 'Linked List', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was charakterisiert eine NP-vollständige Problemklasse?', @cs_id, 1);
SET @q18 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q18, 'Polynomial lösbar', 0),
(@q18, 'Schwierigste Probleme in NP', 1),
(@q18, 'Linear lösbar', 0),
(@q18, 'Immer unlösbar', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welches Paradigma beschreibt funktionale Programmierung?', @cs_id, 1);
SET @q19 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q19, 'Objektorientierung', 0),
(@q19, 'Immutabilität und reine Funktionen', 1),
(@q19, 'Imperative Anweisungen', 0),
(@q19, 'Prozedurale Abstraktion', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was ist ein Deadlock in der Parallelverarbeitung?', @cs_id, 1);
SET @q20 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q20, 'Erhöhte Performance', 0),
(@q20, 'Prozesse warten zyklisch aufeinander', 1),
(@q20, 'Speicherüberlauf', 0),
(@q20, 'Race Condition', 0);