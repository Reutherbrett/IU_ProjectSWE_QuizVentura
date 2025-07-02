-- Philosophie Questions and Answers
INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was versteht Kant unter dem kategorischen Imperativ?', @philosophy_id, 1);
SET @q21 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q21, 'Handeln nach Neigung', 0),
(@q21, 'Unbedingtes moralisches Gebot', 1),
(@q21, 'Utilitaristische Ethik', 0),
(@q21, 'Tugendethik', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welches Problem beschreibt Humes Sein-Sollen-Fehlschluss?', @philosophy_id, 1);
SET @q22 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q22, 'Induktionsproblem', 0),
(@q22, 'Von deskriptiven zu normativen Aussagen', 1),
(@q22, 'Skeptizismus', 0),
(@q22, 'Kausalitätsproblem', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was charakterisiert den Existentialismus nach Sartre?', @philosophy_id, 1);
SET @q23 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q23, 'Determinismus', 0),
(@q23, 'Existenz geht der Essenz voraus', 1),
(@q23, 'Platonischer Idealismus', 0),
(@q23, 'Materialismus', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche erkenntnistheoretische Position vertritt der Empirismus?', @philosophy_id, 1);
SET @q24 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q24, 'Angeborene Ideen sind Erkenntnisquelle', 0),
(@q24, 'Erfahrung als Erkenntnisquelle', 1),
(@q24, 'Vernunft allein führt zur Erkenntnis', 0),
(@q24, 'Intuition als Erkenntnisweg', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was beschreibt Wittgensteins Sprachspielkonzept?', @philosophy_id, 1);
SET @q25 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q25, 'Formale Logik', 0),
(@q25, 'Bedeutung durch Gebrauch im Kontext', 1),
(@q25, 'Universelle Grammatik', 0),
(@q25, 'Semantische Wahrheitstheorie', 0);

-- Mikroökonomie Questions and Answers
INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was beschreibt das Nash-Gleichgewicht?', @economics_id, 1);
SET @q26 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q26, 'Maximaler Gewinn aller Spieler', 0),
(@q26, 'Keine einseitige Abweichung ist vorteilhaft', 1),
(@q26, 'Kooperative Lösung', 0),
(@q26, 'Pareto-optimale Allokation', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche Bedingung charakterisiert Pareto-Effizienz?', @economics_id, 1);
SET @q27 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q27, 'Alle haben gleichen Nutzen', 0),
(@q27, 'Keine Verbesserung ohne Verschlechterung möglich', 1),
(@q27, 'Maximaler Gesamtnutzen', 0),
(@q27, 'Gleichgewichtspreis', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was versteht man unter Preisdiskriminierung 1. Grades?', @economics_id, 1);
SET @q28 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q28, 'Einheitspreis für alle', 0),
(@q28, 'Individuelle Zahlungsbereitschaft abschöpfen', 1),
(@q28, 'Mengenrabatte', 0),
(@q28, 'Zeitliche Preisunterschiede', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welcher Effekt tritt bei Giffen-Gütern auf?', @economics_id, 1);
SET @q29 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q29, 'Normale Nachfragekurve', 0),
(@q29, 'Positive Beziehung zwischen Preis und Nachfrage', 1),
(@q29, 'Perfekte Substitute', 0),
(@q29, 'Einkommenselastizität null', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was charakterisiert einen vollkommenen Markt?', @economics_id, 1);
SET @q30 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q30, 'Wenige große Anbieter', 0),
(@q30, 'Vollständige Information und Homogenität', 1),
(@q30, 'Markteintrittsbarrieren', 0),
(@q30, 'Produktdifferenzierung', 0);

-- Molekularbiologie Questions and Answers
INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche Funktion hat die Telomerase?', @biology_id, 1);
SET @q31 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q31, 'Proteinabbau', 0),
(@q31, 'Verlängerung der Chromosomenenden', 1),
(@q31, 'DNA-Reparatur', 0),
(@q31, 'RNA-Splicing', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was beschreibt die CRISPR-Cas9 Technologie?', @biology_id, 1);
SET @q32 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q32, 'Proteinsequenzierung', 0),
(@q32, 'Präzise Genom-Editierung', 1),
(@q32, 'Zellteilung', 0),
(@q32, 'Immunantwort', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welcher Prozess findet an den Ribosomen statt?', @biology_id, 1);
SET @q33 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q33, 'DNA-Replikation', 0),
(@q33, 'Translation (Proteinbiosynthese)', 1),
(@q33, 'Transkription', 0),
(@q33, 'Glykolyse', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was charakterisiert epigenetische Modifikationen?', @biology_id, 1);
SET @q34 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q34, 'DNA-Sequenzänderungen', 0),
(@q34, 'Vererbbare Genexpressionsänderungen ohne DNA-Mutation', 1),
(@q34, 'Chromosomenaberrationen', 0),
(@q34, 'Punktmutationen', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche Rolle spielt p53 in der Zellregulation?', @biology_id, 1);
SET @q35 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q35, 'Energieproduktion', 0),
(@q35, 'Tumorsuppressor und Zellzyklusstop', 1),
(@q35, 'Zellteilung fördern', 0),
(@q35, 'Protein-Transport', 0);

-- Europäische Geschichte Questions and Answers
INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was waren die Hauptursachen des Dreißigjährigen Krieges?', @history_id, 1);
SET @q36 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q36, 'Nur dynastische Konflikte', 0),
(@q36, 'Konfessionelle und machtpolitische Gegensätze', 1),
(@q36, 'Koloniale Streitigkeiten', 0),
(@q36, 'Handelsrivalitäten', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche Bedeutung hatte der Westfälische Friede 1648?', @history_id, 1);
SET @q37 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q37, 'Ende der Religionskriege', 0),
(@q37, 'Grundlage des modernen Staatensystems', 1),
(@q37, 'Einigung Deutschlands', 0),
(@q37, 'Entstehung der EU', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was charakterisierte den Wiener Kongress 1815?', @history_id, 1);
SET @q38 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q38, 'Liberale Reformen', 0),
(@q38, 'Restauration und Gleichgewichtsprinzip', 1),
(@q38, 'Demokratisierung Europas', 0),
(@q38, 'Nationalstaatenbildung', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche Rolle spielte Metternich im 19. Jahrhundert?', @history_id, 1);
SET @q39 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q39, 'Liberaler Reformer', 0),
(@q39, 'Konservativer Staatskanzler und Restaurationspolitiker', 1),
(@q39, 'Revolutionsführer', 0),
(@q39, 'Nationalistische Bewegung', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was waren die Folgen der Industriellen Revolution?', @history_id, 1);
SET @q40 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q40, 'Rückkehr zur Agrargesellschaft', 0),
(@q40, 'Soziale Umschichtung und Arbeiterbewegung', 1),
(@q40, 'Feudalismus wurde gestärkt', 0),
(@q40, 'Handwerk gewann an Bedeutung', 0);

-- Literaturwissenschaft Questions and Answers
INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was charakterisiert den literarischen Realismus?', @literature_id, 1);
SET @q41 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q41, 'Fantastische Elemente', 0),
(@q41, 'Objektive Wirklichkeitsdarstellung', 1),
(@q41, 'Romantische Idealisierung', 0),
(@q41, 'Symbolistische Abstraktion', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welche Erzähltechnik verwendet der Stream of Consciousness?', @literature_id, 1);
SET @q42 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q42, 'Chronologische Handlung', 0),
(@q42, 'Innere Monologe und Bewusstseinsstrom', 1),
(@q42, 'Objektive Berichterstattung', 0),
(@q42, 'Dialogische Struktur', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was versteht man unter Intertextualität?', @literature_id, 1);
SET @q43 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q43, 'Einheitlicher Textstil', 0),
(@q43, 'Bezüge zwischen verschiedenen Texten', 1),
(@q43, 'Autobiographische Elemente', 0),
(@q43, 'Chronologische Abfolge', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welches Konzept beschreibt die hermeneutische Methode?', @literature_id, 1);
SET @q44 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q44, 'Statistische Analyse', 0),
(@q44, 'Verstehende Textinterpretation', 1),
(@q44, 'Strukturalistische Zerlegung', 0),
(@q44, 'Quantitative Messung', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was charakterisiert die literarische Moderne?', @literature_id, 1);
SET @q45 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q45, 'Traditionelle Formen', 0),
(@q45, 'Experimentelle Formen und Subjektivität', 1),
(@q45, 'Realistische Darstellung', 0),
(@q45, 'Moralische Belehrung', 0);

-- Kognitionspsychologie Questions and Answers
INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was beschreibt das Arbeitsgedächtnismodell von Baddeley?', @psychology_id, 1);
SET @q46 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q46, 'Einheitlicher Speicher', 0),
(@q46, 'Zentrale Exekutive mit Subsystemen', 1),
(@q46, 'Sequenzielle Verarbeitung', 0),
(@q46, 'Unbegrenzte Kapazität', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welcher Effekt zeigt sich beim Stroop-Test?', @psychology_id, 1);
SET @q47 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q47, 'Gedächtnisverbesserung', 0),
(@q47, 'Interferenz zwischen Wort und Farbe', 1),
(@q47, 'Erhöhte Aufmerksamkeit', 0),
(@q47, 'Sprachverständnis', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was versteht man unter der Theorie des dualen Kodierens?', @psychology_id, 1);
SET @q48 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q48, 'Doppelte Gedächtnisspeicher', 0),
(@q48, 'Verbale und bildliche Informationsverarbeitung', 1),
(@q48, 'Zwei Gehirnhälften', 0),
(@q48, 'Bewusstes und unbewusstes Denken', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Welches Phänomen beschreibt die Verfügbarkeitsheuristik?', @psychology_id, 1);
SET @q49 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q49, 'Perfekte Erinnerung', 0),
(@q49, 'Wahrscheinlichkeitsschätzung durch Abrufbarkeit', 1),
(@q49, 'Logisches Schlussfolgern', 0),
(@q49, 'Emotionale Bewertung', 0);

INSERT INTO Fragen (Frage_Text, Kategorie_ID, Created_by) VALUES 
('Was charakterisiert automatische vs. kontrollierte Prozesse?', @psychology_id, 1);
SET @q50 = LAST_INSERT_ID();

INSERT INTO Antworten (Frage_ID, Antworttext, is_correct) VALUES 
(@q50, 'Beide benötigen gleiche Aufmerksamkeit', 0),
(@q50, 'Automatisch: schnell, unbewusst; Kontrolliert: langsam, bewusst', 1),
(@q50, 'Kontrollierte sind immer genauer', 0),
(@q50, 'Nur einer kann aktiv sein', 0);