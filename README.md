# Ys WP Speech Balloon

ショートコードで吹き出し機能をつくる為のプラグイン

## ショートコードテンプレート

```
[yswp_speech_balloon image="" type="r" name=""]content[/yswp_speech_balloon]
```

## パラメーター

- image(必須)
  - 表示する画像のURLを指定
- type（必須）
  - 吹き出しの表示向きを指定する
  - 「r」か「l」で指定（小文字）
    - r: 吹き出しを右側に表示（デフォルト）
    - l: 吹き出しを左側に表示
- name
  - アイコン画像の下に表示する名前
- alt
  - アイコン画像のalt属性
- class
  - 吹き出し部分を作るHTMLの一番外側の要素に任意のクラスをつけることができます。

