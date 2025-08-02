-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Ago 02, 2025 alle 11:44
-- Versione del server: 10.4.28-MariaDB
-- Versione PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hw1`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `gioco`
--

CREATE TABLE `gioco` (
  `id` int(254) NOT NULL,
  `titolo` varchar(200) NOT NULL,
  `genere` varchar(200) NOT NULL,
  `anno` int(200) NOT NULL,
  `descrizione` varchar(200) NOT NULL,
  `prezzo` decimal(65,0) NOT NULL,
  `immagine` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `gioco`
--

INSERT INTO `gioco` (`id`, `titolo`, `genere`, `anno`, `descrizione`, `prezzo`, `immagine`) VALUES
(1, 'f123', 'sportivo', 2023, 'gioco di formula 1', 43, 'immagini/f123.jpg'),
(2, 'football manager 2024', 'gestionale, sportivo', 2023, 'Gioco gestionale di calcio', 27, 'immagini/footman2024.jpg'),
(3, 'Ready or not', 'Azione, tattico', 2021, 'Gioco tattico di simulazione di una squadra di Agenti speciali', 39, 'immagini/readyornot.jpg'),
(4, 'ww2k24', 'Sportivo, Simulazione', 2023, 'Gioco di combattimento di wrestling', 59, 'immagini/ww2k24.jpg'),
(5, 'God of War', 'Azione', 2018, 'Gioco della serie \"God of war\" ambientato nel regno norreno', 29, 'immagini/godofwar.jpg'),
(6, 'Assassin\'s Creed Shadows', 'Azione, Storico', 2024, 'Gioco della serie \"Assassin\'s Creed\" ambientato in Giappone', 49, 'immagini/assassin.jpg'),
(7, 'Tekken 8', 'Combattimento', 2024, 'Gioco di combattimento della serie \"Tekken\"', 39, 'immagini/tekken.jpg'),
(8, 'Elden Ring', 'Gioco di ruolo', 2022, 'Gioco di ruolo stile souls like', 49, 'immagini/eldenring.jpg'),
(9, 'Red dead redemption 2', 'Azione, Gioco di ruolo', 2018, 'Gioco di ruolo ambientato nel far west di Rockstar Games', 59, 'immagini/reddead.jpg'),
(10, 'Undertale', 'Gioco di ruolo', 2015, 'Gioco indipendente ambientato nelle rovine magiche della Terra', 9, 'immagini/undertale.jpg'),
(11, 'Outlast', 'Horror', 2013, 'Gioco horror psicologico', 19, 'immagini/outlast.jpg'),
(12, 'The last of us 2', 'Azione', 2020, 'Seguito del primo capitolo di \"The last of us\"', 39, 'immagini/tlou.jpg'),
(13, 'Death Stranding 2', 'Avventura', 2025, 'Secondo capitolo della serie \"Death stranding\"', 62, 'immagini/death.jpg'),
(14, 'Doom: The dark Ages', 'Azione', 2025, 'Ultimo capitolo della serie Doom', 59, 'immagini/doom.jpg'),
(15, 'Clair obscure: Expedition 33', 'Gioco di ruolo', 2025, 'Gioco indipendente creato dagli sviluppatori di Ubisoft. Ambientato in una Francia distrutta', 49, 'immagini/expedition.jpg'),
(16, 'Kingdom come deliverance 2', 'Avventura', 2025, 'Secondo capitolo della serie \"Kingdom come deliverance\"', 60, 'immagini/kingdom.jpg'),
(17, 'Grand Theft Auto VI', 'Azione, gioco di ruolo', 2026, 'Ultimo capitolo della serie \"Grand Theft Auto\" di Rockstar', 100, 'immagini/gta.jpg'),
(18, 'Gears of War: E-Day', 'Azione', 2026, 'Ultimo capitolo della sage \"Gears of war\"', 70, 'immagini/gears.jpg'),
(19, 'Subnautica 2', 'Avventura', 2026, 'Secondo capitolo della seria \"Subnautica\". Esplora i fondali marini e svela misteri rimasti irrisolti!', 50, 'immagini/sub.jpg'),
(20, 'Resident Evil: Requiem', 'Horror', 2026, 'Ultimo capitolo della saga \"Resident Evil\". Prendi i panni di Rose, e affronta nuovi agghiaccianti nemici', 70, 'immagini/residentevil.jpg'),
(21, 'Prince of persia, sand of time', 'Avventura', 2026, 'Ultimo capitolo della saga di \"Prince of Persia\"', 60, 'immagini/princeofpersia.jpg'),
(22, 'WreckFest 2', 'Sportivo', 2026, 'Secondo capitolo della seria \"Wreckfest\"', 70, 'immagini/wreckfest.jpg'),
(23, 'Game of Thrones: War for Westeros', 'Strategico', 2026, 'Gioco strategico ispirato alla serie Game of Thrones', 60, 'immagini/gameof.jpg'),
(24, 'Marvel 1943: Rise of Hydra', 'Azione', 2026, 'Gioco di combattimento ispirato dai fumetti Marvel', 70, 'immagini/marvel.jpg');

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini`
--

CREATE TABLE `ordini` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `nome_carta` varchar(100) NOT NULL,
  `data` datetime NOT NULL,
  `totale` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordini`
--

INSERT INTO `ordini` (`id`, `user_id`, `nome_carta`, `data`, `totale`) VALUES
(1, 5, 'Alessio Salemi', '2025-07-31 04:23:33', 199.00),
(2, 5, 'Hw1', '2025-08-01 19:13:42', 147.00),
(3, 5, 'Hw1', '2025-08-02 11:22:22', 449.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `ordini_prodotti`
--

CREATE TABLE `ordini_prodotti` (
  `id` int(11) NOT NULL,
  `ordine_id` int(11) NOT NULL,
  `gioco_nome` varchar(200) NOT NULL,
  `quantita` int(11) NOT NULL,
  `prezzo_unitario` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `ordini_prodotti`
--

INSERT INTO `ordini_prodotti` (`id`, `ordine_id`, `gioco_nome`, `quantita`, `prezzo_unitario`) VALUES
(1, 1, 'Tekken 8', 1, 39.00),
(2, 1, 'Prince of persia, sand of time', 1, 60.00),
(3, 1, 'Grand Theft Auto VI', 1, 100.00),
(4, 2, 'Subnautica 2', 1, 50.00),
(5, 2, 'football manager 2024', 1, 27.00),
(6, 2, 'Resident Evil: Requiem', 1, 70.00),
(7, 3, 'Doom: The dark Ages', 1, 59.00),
(8, 3, 'Resident Evil: Requiem', 2, 70.00),
(9, 3, 'Prince of persia, sand of time', 1, 60.00),
(10, 3, 'Death Stranding 2', 1, 62.00),
(11, 3, 'Undertale', 1, 9.00),
(12, 3, 'Elden Ring', 1, 49.00),
(13, 3, 'WreckFest 2', 1, 70.00);

-- --------------------------------------------------------

--
-- Struttura della tabella `users`
--

CREATE TABLE `users` (
  `username` varchar(15) NOT NULL,
  `password` varchar(60) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dump dei dati per la tabella `users`
--

INSERT INTO `users` (`username`, `password`, `name`, `surname`, `email`, `id`) VALUES
('ales', '$2y$10$bo/DEzmOb69XnEMWePFhee/jEP0irjE25IEx83lQilrVeyGh2gsoG', 'ale', 'sale', 'ales@gmail.com', 2),
('giovann', '$2y$10$Q2XK7Irk83A3dHijOEj1W.HKMU//rVO5u/99Hc15GM7/Mpr52XKB6', 'giova', 'luca', 'giov@gmail.com', 3),
('AlessioSalemi', '$2y$10$guZrNJmsOE4v/onQXNClheGqew2vmxSqLwLUkB3Ovalk5uPGM/95C', 'Alessio', 'Salemi', 'alessiosalemi1802@gmail.com', 5),
('AlessioSalemi1', '$2y$10$sZUSCVL0T0fSnrFezN13.uG4uPF7G1bdI2GPOtypOGxfQo7s1p6xK', 'Alessio', 'Salemi', 'al@gmail.com', 6);

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `gioco`
--
ALTER TABLE `gioco`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ordini`
--
ALTER TABLE `ordini`
  ADD PRIMARY KEY (`id`);

--
-- Indici per le tabelle `ordini_prodotti`
--
ALTER TABLE `ordini_prodotti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ordine_id` (`ordine_id`);

--
-- Indici per le tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `gioco`
--
ALTER TABLE `gioco`
  MODIFY `id` int(254) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT per la tabella `ordini`
--
ALTER TABLE `ordini`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT per la tabella `ordini_prodotti`
--
ALTER TABLE `ordini_prodotti`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT per la tabella `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `ordini_prodotti`
--
ALTER TABLE `ordini_prodotti`
  ADD CONSTRAINT `ordini_prodotti_ibfk_1` FOREIGN KEY (`ordine_id`) REFERENCES `ordini` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
