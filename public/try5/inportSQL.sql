
CREATE DATABASE secpgdb CHARACTER SET utf8 COLLATE utf8_general_ci;

-- ユーザーの作成
CREATE USER 'testuser'@'localhost' IDENTIFIED BY 'Abcc&2291';

-- データベースへのアクセス権限を付与
GRANT ALL PRIVILEGES ON secpgdb.* TO 'testuser'@'localhost';

-- localhostにあるデータベースにアクセスするための設定
SET GLOBAL time_zone = '+00:00'; -- UTCタイムゾーンを設定



USE secpgdb;

CREATE TABLE user (
  id INT AUTO_INCREMENT PRIMARY KEY,
  name VARCHAR(255) NOT NULL,
  kana VARCHAR(255) NOT NULL,
  email VARCHAR(255) NOT NULL,
  password VARCHAR(255) NOT NULL,
  address VARCHAR(255) NOT NULL
);

-- Userテーブルに10件のサンプルデータをINSERTするSQL文
INSERT INTO user (name, kana, email, password, address)
VALUES
  ('田中太郎', 'タナカタロウ', 'taro@example.com', 'password1', '東京都渋谷区'),
  ('山田花子', 'ヤマダハナコ', 'hanako@example.com', 'password2', '大阪府大阪市'),
  ('佐藤次郎', 'サトウジロウ', 'jiro@example.com', 'password3', '福岡県福岡市'),
  ('鈴木三郎', 'スズキサブロウ', 'saburo@example.com', 'password4', '北海道札幌市'),
  ('伊藤真由美', 'イトウマユミ', 'mayumi@example.com', 'password5', '神奈川県横浜市'),
  ('小林健太', 'コバヤシケンタ', 'kenta@example.com', 'password6', '千葉県千葉市'),
  ('中村美咲', 'ナカムラミサキ', 'misaki@example.com', 'password7', '京都府京都市'),
  ('加藤大輔', 'カトウダイスケ', 'daisuke@example.com', 'password8', '埼玉県さいたま市'),
  ('吉田かおり', 'ヨシダカオリ', 'kaori@example.com', 'password9', '愛知県名古屋市'),
  ('西田直樹', 'ニシダナオキ', 'naoki@example.com', 'password10', '静岡県静岡市');


-- Bookテーブルを作成するSQL文
CREATE TABLE book (
  id INT AUTO_INCREMENT PRIMARY KEY,
  title VARCHAR(255) NOT NULL,
  author VARCHAR(255) NOT NULL,
  publisher VARCHAR(255) NOT NULL,
  published_date DATE NOT NULL,
  price INT NOT NULL
);

-- Bookテーブルに10件のサンプルデータをINSERTするSQL文
INSERT INTO book (title, author, publisher, published_date, price)
VALUES
  ('Java言語プログラミングレッスン', '結城浩', 'ソフトバンククリエイティブ', '2021-03-12', 3520),
  ('Effective Java 第3版', 'Joshua Bloch', 'ピアソンエデュケーション', '2018-01-31', 5280),
  ('C言語による標準アルゴリズム事典', '岩田陽一', '技術評論社', '2012-08-08', 3300),
  ('プログラミング言語Go', 'Alan A. A. Donovan, Brian W. Kernighan', 'オライリー・ジャパン', '2016-02-22', 3850),
  ('リーダブルコード', 'Dustin Boswell, Trevor Foucher', 'オライリー・ジャパン', '2012-04-12', 3300),
  ('Clean Code', 'Robert C. Martin', 'ピアソンエデュケーション', '2008-08-11', 4620),
  ('Kubernetes完全ガイド', '古谷善之', '技術評論社', '2021-02-17', 4840),
  ('Docker実践ガイド', '鈴木慎司', 'インプレス', '2014-12-19', 2750),
  ('はじめてのデータベース', '高橋麻奈, 大友孝一郎', '技術評論社', '2021-01-20', 3080),
  ('現場で使える Ruby on Rails 5速習実践ガイド', '掌田津耶乃, 株式会社技術評論社', '技術評論社', '2018-02-20', 3700);
