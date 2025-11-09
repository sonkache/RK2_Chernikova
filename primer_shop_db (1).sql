
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
!40101 SET NAMES utf8mb4 */;

--
-- База данных: `primer_shop_db`
--

-- --------------------------------------------------------

--
-- Структура таблицы `cart`
--

CREATE TABLE `cart` (
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `qty` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `feedback`
--

CREATE TABLE `feedback` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(190) NOT NULL,
  `subject` varchar(200) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Структура таблицы `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `fio` varchar(150) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `address` varchar(255) NOT NULL,
  `payment_method` enum('card','sbp','cash') NOT NULL DEFAULT 'card',
  `status` enum('pending','paid','cancelled') NOT NULL DEFAULT 'pending',
  `total` decimal(10,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- --------------------------------------------------------

--
-- Структура таблицы `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
-- --------------------------------------------------------

--
-- Структура таблицы `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `description` text NOT NULL,
  `price` decimal(10,2) NOT NULL,
  `image` varchar(200) NOT NULL,
  `brand` varchar(120) NOT NULL,
  `volume_ml` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Дамп данных таблицы `products`
--

INSERT INTO `products` (`id`, `title`, `description`, `price`, `image`, `brand`, `volume_ml`, `created_at`) VALUES
(1, 'PP праймер для лица Pink Primer & Care, 15 мл', 'PP праймер обладает свойствами увлажняющего крема благодаря уникальной формуле, обогащенной Diospyros kaki (Хурма Восточная), день за днем улучшает текстуру кожи и помогает уменьшить видимость пор.', 1717.00, '1.jpg', 'ERBORIAN', 15, '2025-11-04 17:30:39'),
(2, 'Праймер для лица увлажняющий Aqua Splash Grip Primer, 30 мл', ' Формула содержит 5% глицерина, ниацинамид, гиалуроновую кислоту и сок огурца, увлажняет и освежает кожу, обеспечивая безупречный тон лица в течение дня.', 527.00, '2.jpg', 'CATRICE', 30, '2025-11-04 17:30:39'),
(3, 'Увлажняющий праймер-желе jelly GRIP HYDRATING PRIMER, 29 мл', 'Особый желеобразный праймер не только увлажняет, но и закрепляет макияж. Таким образом, он обеспечивает максимальный эффект фиксации и длительную стойкость макияжа.', 439.00, '3.jpg', 'ESSENCE', 29, '2025-11-04 17:30:39'),
(4, 'База под макияж, праймер для лица 3в1 CAPSULE, 03 MATTE', 'База под макияж B.COLOUR PROFESSIONAL 03 Glow придает коже сияние, выравнивает текстуру и тон, стирает признаки усталости, придает свежий и отдохнувший вид, подготавливая кожу к нанесению макияжа.', 425.00, '4.jpg', 'B.COLOUR PROFESSIONAL', 35, '2025-11-04 17:30:39'),
(5, 'Праймер для сияния кожи SPF 35, 30 мл', 'Невесомая, не содержащая масел текстура моментально увлажняет и разглаживает поверхность кожи, облегчает нанесение макияжа и обеспечивает его стойкость и яркость. Придает сияние благодаря легкому перламутру, который красиво отражает свет. За счет антиоксидантов и SPF 35 в составе защищает кожу.', 4250.00, '5.jpg', 'NARS', 30, '2025-11-04 17:30:39'),
(6, 'Праймер для лица с ароматом кокоса COCONUT DROP PRIMER, 35 мл', 'Одна капелька - и твоя кожа мягкая и гладкая, как персик. А аромат кокоса - просто WOW!\nЭтот продукт не тестировался на животных.', 379.00, '6.jpg', 'SODA', 35, '2025-11-04 17:30:39'),
(7, 'Основа под макияж матирующая Base Coat Prime Expert Matt & Sebum Control, 35 г', 'Основа под макияж матирующая PRIME EXPERT Matt & sebum control идеально подготавливает комбинированную и склонную к жирности кожу к нанесению тональных средств. Делает кожу безупречно матовой, гладкой и бархатистой.', 430.00, '7.jpg', 'LUXVISAGE', 35, '2025-11-04 17:30:39'),
(8, 'Крем праймер для лица увлажняющий, 65 мл', 'Увлажняющий праймер для лица The Act не только продлевает стойкость макияжа в качестве основы, но и действует как самостоятельный уход: матирует, усиливает естественное сияние и выравнивает цвет и текстуру кожи.', 967.00, '8.jpg', 'THE ACT', 65, '2025-11-04 17:30:39'),
(9, 'Сыворотка-праймер HELLO, GOOD STUFF! GLOW SERUM PRIMER, 30мл', 'Essence Сыворотка-праймер HELLO, GOOD STUFF! GLOW SERUM PRIMER. Формула сыворотки насыщена арбузной водой и ниацинамидом и на 93% состоит из натуральных ингредиентов.', 537.00, '9.jpg', 'ESSENCE', 30, '2025-11-04 17:30:39'),
(10, 'Крем-праймер для лица Защитный с SPF30 Liposomal Sun Block, 50 мл', 'Обязательно используйте круглый год вовремя ретинолового ухода. Крем надежно защищает кожу от вредного воздействия UVA и UVB лучей, предотвращая фотостарение и появление пигментных пятен.', 1044.00, '10.jpg', 'ARAVIA PROFESSIONAL', 50, '2025-11-04 17:30:39'),
(11, 'Основа под макияж выравнивающая Base Coat Prime Expert Pore Filler, 35 г', 'Прозрачная основа под макияж выравнивающая PRIME EXPERT Pore filler с эффектом мягкого фокуса заполняет и маскирует поры, мимические морщинки и сглаживает другие неровности, идеально выравнивая рельеф кожи.', 430.00, '11.jpg', 'LUXVISAGE', 35, '2025-11-04 17:30:39'),
(12, 'База под макияж KOREAN SECRET, 20 мл\n4.7\n35 оценок\n', 'Корректирующая база для естественного сияния кожи. Освежает и придаёт коже ровный тон, профессионально готовит кожу к макияжу. Скрывает покраснения и следы купероза. Разглаживает рельеф кожи и помогает макияжу держаться дольше благодаря бондинг-технологии.', 614.00, '12.jpg', 'RELOUIS', 20, '2025-11-04 17:30:39'),
(13, 'Праймер для лица скрывающий покраснения Anti-Redness Primer, № 21 Green, 20 мл\n5.0\n10 оценок\n', 'Праймер против покраснений с успокаивающим соком алоэ вера эффективно выравнивает тон кожи, придавая ей красивый и здоровый тон.\nУльтралегкая увлажняющая формула быстро впитывается, легко наносится и оставляет ощущение мягкости и шелковистости.', 2061.00, '13.jpg', 'MAKE UP FACTORY', 20, '2025-11-04 17:30:39'),
(14, 'Праймер-обезжириватель для бровей, 50 мл', 'Мягко и эффективно подготавливает зону бровей к процедуре окрашивания. Устраняет остатки макияжа, очищает и обезжиривает кожу и волоски без пересушивания. Способствует равномерному окрашиванию и продлевает стойкость результата.', 369.00, '14.jpg', 'BRONSUN', 50, '2025-11-04 17:30:39'),
(15, 'Корректирующий праймер для лица PRIME ME, № 002 для кожи с покраснениями, 30 мл', 'Корректирующий праймер для лица для тусклой кожи. Обеспечивает оптическую коррекцию сероватого оттенка, типичного для тусклой, потерявшей жизненную силу кожи.', 2519.00, '15.jpg', 'PUPA', 30, '2025-11-04 17:30:39');

-- --------------------------------------------------------

--
-- Структура таблицы `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(190) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
--
-- Индексы сохранённых таблиц
--

--
-- Индексы таблицы `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`user_id`,`product_id`),
  ADD KEY `fk_cart_product` (`product_id`);

--
-- Индексы таблицы `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_orders_user` (`user_id`);

--
-- Индексы таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_items_order` (`order_id`),
  ADD KEY `fk_items_product` (`product_id`);

--
-- Индексы таблицы `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Индексы таблицы `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT для сохранённых таблиц
--

--
-- AUTO_INCREMENT для таблицы `feedback`
--
ALTER TABLE `feedback`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT для таблицы `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT для таблицы `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT для таблицы `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT для таблицы `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Ограничения внешнего ключа сохраненных таблиц
--

--
-- Ограничения внешнего ключа таблицы `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_cart_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_cart_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `fk_orders_user` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Ограничения внешнего ключа таблицы `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `fk_items_order` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_items_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);
COMMIT;
