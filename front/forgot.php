<div class="cent" style="width: fit-content;">
    <p>請輸入信箱以查詢密碼</p>
    <div><input class="email" type="email" name="email" style="width: 300px;"></div>
    <p class="result"></p>
    <div>
        <!-- <input type="hidden" name="table" value="User"> -->
        <button onclick="forgot()">尋找</button>
    </div>
</div>

<script>
    function forgot() {
        console.log($(".email").val());
        $.get("./api/forgot.php", {
            email: $(".email").val()
        }, (result) => {
            console.log(result);
            $(".result").text(result);
        })

    }

    // function login() {
    //     let user = {
    //         acc: $("#acc").val(),
    //         pw: $("#pw").val()

    //     }

    //     $.post("./api/chk_acc.php", user, (result) => {
    //         console.log(result);
    //         if (parseInt(result) === 1) { // 強制轉型成數字
    //             // 有帳號
    //             $.post("./api/chk_pw.php", user, (result) => {
    //                 console.log(result);
    //                 if (parseInt(result) === 1) {
    //                     // 帳密正確
    //                     if (user.acc === 'admin') {
    //                         // 管理者帳號
    //                         location.href = 'back.php';
    //                     } else {
    //                         // 一般會員
    //                         location.href = 'index.php';
    //                     }
    //                 } else {
    //                     // 密碼錯誤
    //                     alert("密碼錯誤");
    //                 }
    //             })
    //         } else {
    //             // 無帳號
    //             alert("查無帳號");
    //             reset();
    //         }
    //     });
    // }
</script>