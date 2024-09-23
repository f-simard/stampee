INSERT INTO `stampee`.`Devise` (`idDevise`, `nom`) VALUES
('USD', 'US Dollar'),
('EUR', 'Euro'),
('JPY', 'Japanese Yen');

INSERT INTO `stampee`.`Pays` (`idPays`, `nom`) VALUES
('USA', 'United States'),
('FRA', 'France'),
('JPN', 'Japan');

INSERT INTO `stampee`.`Langue` (`idLangue`, `nom`) VALUES
('EN', 'English'),
('FR', 'French'),
('JP', 'Japanese');

INSERT INTO `membre` (`idMembre`, `nom`, `prenom`, `adresseCivique`, `ville`, `nomUtilisateur`, `motDePasse`, `codePostal`, `courriel`, `estAdmin`, `avatar`, `idDevise`, `idPays`, `idLangue`) VALUES
(1, 'Ministrateur', 'Addie', '', '', 'admin', '$2y$10$1DCs9/uK2yX/xeu2/e8ToenIqXa9Kd678GLfM35MXOAcrdUtWyjGy', '', 'admin@test.com', 1, '', 'EUR', 'FRA', 'FR'),
(2, 'Doe', 'Jane', '', '', 'test', '$2y$10$b798W80HbCRQUHpXHLGwUOcYMa3PW7hc8QW9xoTgUq10qKQ0/sWea', '', 'test@test.com', 0, '', 'JPY', 'JPN', 'JP');