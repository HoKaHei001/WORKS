/*
1.「登録」ボタンをクリックしたときの処理
・入力されたテキストと削除ボタンをli要素と一緒にulタグの中に追加して表示する
・送信を中止する（liが追加された後でも送信中止）
・追加後、二重投稿を防ぐためにテキスト欄を空欄にする
・テキスト欄が空のときはアラートを出す「予定を入力して下さい」
・ローカルストレージにデータを保存する

  ※「入力されたテキスト」と「削除ボタンのタグ」と
    「追加されるli要素とその内容」は変数に入れておく
*/

// オブジェクトの準備
const $name_text = $("#name");
const $comment_text = $(".comment_text");//テキスト欄
const $inputBtn = $(".submit");//送信ボタン
const $clearBtn = $(".clear");//クリアボタン
const $formObj = $(".comment_form");//formタグ
const $list = $(".comment_list");//追加先のulタグ
const removeBtn = "<span class='remove'>×</span>";//削除ボタン
let name_err = "";
let comment_err = "";
const name_err_div = $("#name_err");
const comment_err_div = $("#comment_err");

//送信ボタンがクリックされたときの処理
$formObj.on("submit", function (event) {
  //入力されたテキストを取得して変数に格納する
  let Text = $comment_text.val();
  let name = $name_text.val();
  let year = new Date().getFullYear();
  let month = new Date().getMonth() + 1;
  var num = new Date().getDay();
  var weekday = ["日", "月", "火", "水", "木", "金", "土"];
  let week = weekday[num];
  let hour = new Date().getHours();
  var minute = new Date().getMinutes();
  let second = new Date().getSeconds();
  let date = year + "/" + month + "/" + week + "曜日" + hour + ":" + minute + ":" + second;


  //liタグの中に、テキストと削除ボタンを入れる
  let itemSet = "<li class='comment_item fadeIn'>" + "<span class='name_style'>" + name + "さん" + "</span>" + "<span class='date_style'>" + date + "</span>" + "<br>" + "<span class='comment_style'>" + Text + "</span>" + removeBtn + "</li>";
  if (name == "" && Text == "") {
    //空欄のときにアラートを出す
    // alert("名前を入力して下さい！");
    name_err = "※名前を入力してください！";
    name_err_div.text(name_err)
    comment_err = "※コメントを入力してください！";
    comment_err_div.text(comment_err);
    //送信中止
    event.preventDefault();
  } else if (name == "") {
    name_err = "※名前を入力してください！";
    name_err_div.text(name_err)
    comment_err_div.text("");
    event.preventDefault();
  } else if (Text == "") {
    // alert("コメントを入力して下さい！");
    comment_err = "※コメントを入力してください！";
    name_err_div.text("")
    comment_err_div.text(comment_err);
    event.preventDefault();
  } else {
    //ulタグの中にliタグを追加する
    name_err_div.text("")
    comment_err_div.text("");
    $list.append(itemSet);
    //テキスト欄を空欄にする
    $name_text.val("");
    $comment_text.val("");
    //手順1.保存したいデータ（追加されたli）を変数に代入する
    const listItem = $list.html();//ulタグの子要素（liタグ）をまとめて取得
    //手順2.上記データをJSONデータに変換したものを変数に代入する
    const JSON_Data = JSON.stringify(listItem);
    //手順3.そのデータを保存する（ローカルストレージの設定）キー名はデータを取得する際に必要な名前
    localStorage.setItem("comment_list", JSON_Data);

    //これを記述しないと、×で一つ消去した後にリロードすると、残っていたliが二重に追加されてしまう。
    localStorage.removeItem("nokorimono");

    //送信中止
    event.preventDefault();
  }
});

/*
2.「全てクリア」ボタンをクリックしたときの処理
  confirm()でOKとキャンセルを問う
  OKのときは全てのli要素をフェードアウトしてからソースコードを除去
*/

$clearBtn.on("click", function () {
  if (!confirm("本当に削除しますか？")) {
    /*キャンセル時の処理*/
    return false;
  } else {
    // OKのときの処理
    //追加されたliタグを取得して変数に格納する
    const $liTags = $(".comment_list li");
    //それをフェードアウト
    $(".comment_item").removeClass("fadeIn");
    $liTags.fadeOut("500", function () {
      //ソースコードに残ったliタグを完全に除去する
      $(this).remove();
    });
    //手順7.ローカルストレージの全データを消去
    localStorage.clear();
  }
});



/*
3.「×」ボタン（li要素）をクリックしたときの処理
・クリックしたli要素のみを削除できるようにする
  ※appendで追加した要素にイベントを設定するときの注意点
  参考ページ　https://qiita.com/ayies128/items/5d044bc08b9308767f4c
  これではイベントが発火しない
  $("span.remove").click(function(){})または
  $("span.remove").on("click",function(){})
*/
//appendで追加したliにイベントを設定する
$(document).on("click", ".remove", function () {
  if (!confirm("本当に削除しますか？")) {
    //キャンセル時の処理
    return false;
  } else {
    //OK時の処理
    $(this).parent().removeClass("fadeIn");

    $(this).parent().fadeOut(500, function () {
      $(this).hide();
      $(this).remove();
      //手順8.ローカルストレージの全データを一旦消去
      localStorage.clear();
      //手順9.ソースコードに残ったliを改めて取得する
      const liData = $(".comment_list").html();
      //手順10.上記データをJSONデータに変換したものを変数に代入する
      const jsonStr_nokori = JSON.stringify(liData);
      //手順11.そのデータ（「×」で削除したもの以外）を保存する（ローカルストレージの設定）キー名はデータを取得する際に必要な名前このとき保存されたデータが、上記ブラウザ更新時の処理で表示される
      localStorage.setItem("nokorimono", jsonStr_nokori);
    });
  }
});


//ブラウザ更新時の処理
//手順4.手順3で保存したデータ（JSON）を取得して変数に代入する
const jsonStr = localStorage.getItem("comment_list");
//残ったliタグを取得して変数に格納
const jsonStr2 = localStorage.getItem("nokorimono");
//手順5.JSON形式の文字列をJavaScriptのオブジェクトに変換して変数に代入する 記述法 JSON.parse(変数名);
const jsObj = JSON.parse(jsonStr);
const jsObj2 = JSON.parse(jsonStr2);
//手順6.append()でulタグの中にそのデータ（liタグ）を追加する
$list.append(jsObj);
$list.append(jsObj2);



