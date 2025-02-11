# 環境構築手順

1. **リポジトリをクローン**
```
git clone https://github.com/Fukushinaharuto/fib_api.git
```
2. **Dockerイメージをビルド**
```
docker compose build
```
3. **バックエンドコンテナに入る**
```
docker compose run back /bin/bash
```
4. **依存関係をインストール**
- コンテナ内で下記のコマンドを実行します。
```
composer install
```
- 上記のコードを実行後、コンテナを出ます。
5. **コンテナを起動**
```
docker compose up -d
```

# **テスト方法**

## **1. curlコマンドを使用したテスト**
```
curl -X GET -H "Accept: application/json" "http://localhost:8005/api/fib?n=99"
```

## **2. PHPUnitを使用したテスト**
- backフォルダ内で実行します。
```
php artisan test
```

# **ソースコードの構成・概要**
### プロジェクト名
fib_api

### プロジェクトの目的
フィボナッチ数列のn番目の数を返す。

### 技術スタック
| 言語・フレームワーク・その他 | バージョン |
| -------------------- | ---------- |
| PHP                  | 8.3.12     |
| Laravel              | 11.41.3    |
| PHPUnit              | 11.5.6     |
| Docker               | 27.4.0     |
| GMP                  | 2:6.2.1+dfsg1-1.1|

### 使用したファイル概要とディレクトリ構成
```
fib_api/
 ├── back/
 │   ├── app/Http
 │   │       ├── Controllers/FibonacciController.php  #フィボナッチ数列のn番目の数を返す関数indexが記載されている。
 │   │       └── Requests/FibonacciController.php     #リクエストnのバリデーションとそのエラーメッセージが記載されている。
 │   │      
 │   ├── routes/api.php                               #APIのルーティングが記載されている
 │   └── tests/Feature/FibonacciControllerTest.php    #FibonacciControllerのテストケースが記載されている。
 │
 ├── docker-compose.yml                               #dockerコンテナの設定が記載されている。
 └── dockerfile                                       #dockerイメージの設定が記載されている。
```



