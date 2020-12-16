# docker-laravel
## 開発注意点  
`docker-compose up`  
でdockerコンテナの起動をする  
`docker-compose exec app bash`  
でappコンテナに入る。基本的にこの中に入ってから`php artisan `コマンドを実行。  

`php artisan tinker`  
データの確認や作成ができる。

## Pusherに関してやってほしいこと(12/16追記)
https://gsacademy-lab10.slack.com/archives/G01GG8BG39Q/p1608130230038500
`infra/php/Dockerfile`をslackのスニペット通りに上書き変更してください。
上書きしたら
`docker-compose build`  
してください。

`docker-compose exec app bash`  
でappコンテナに入って以下のコマンドを実行してください。

### インストールされたjsモジュールを全部消す
`rm -rf node_modules`

### インストールされたjsモジュールのバージョン情報を消す
`rm package-lock.json`

### npmのキャッシュをクリアする
`npm cache clear --force`

### 再度jsモジュールを全部入れ直して、実行する
`npm install`
`npm run dev`

## 環境構築手順
0. 前提
  まずDockerをダウンロードする。  
  Macの方：https://docs.docker.com/docker-for-mac/install  
  Winの方：https://docs.docker.com/docker-for-windows/install  
1. まず、このプロジェクトをGitKrakenでcloneする。  
 URL: `https://github.com/ryohei0419/docker-laravel.git`  
2. VSCodeでクローンしたプロジェクトを開く  
　　Docker for Desktopを起動する　　
3. VSCodeでターミナルを開く  
4. プロジェクトのDockerイメージなどを作成  
`docker-compose up -d --build`  
5. コンテナに入る  
`docker-compose exec app bash`  
6. 入ったコンテナの中でコマンドを叩く  
`composer install`  
7. 入ったコンテナの中でコマンドを叩く  
`cp .env.example .env`  
8. App Keyの作成  
`php artisan key:generate`  
9. ローカルホストで表示  
`http://127.0.0.1:10080`でブラウザを開く  

9でLaravelの最初の画面が表示されていれば無事完了  

