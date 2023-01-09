<fieldset class="cent" style="width: fit-content;">
    <legend>會員登入</legend>
    <table>
        <tr>
            <td style="width: 150px;background:#d9d9d9;">帳號</td>
            <td><input type="text" name="acc" id="acc"></td>
        </tr>
        <tr>
            <td style="width: 150px;background:#d9d9d9;">密碼</td>
            <td><input type="password" name="pw" id="pw"></td>
        </tr>
    </table>
    <div>
        <input type="hidden" name="table" value="Admin">
        <button onclick="login()">登入</button>
        <button onclick="reset()">清除</button>
        <div style="float: right;">
            <a href="?do=forgot">忘記密碼</a> |
            <a href="?do=reg">尚未註冊</a>
        </div>
    </div>
</fieldset>

<script>
    // reset 功能
    function reset() {
        $("#acc,#pw").val('');
    }

    function login() {
        let user = {
            acc: $("#acc").val(),
            pw: $("#pw").val()
        }

        $.post("./api/chk_acc.php", user, (result) => {
            console.log(result);
            if (parseInt(result) === 1) { // 強制轉型成數字
                // 有帳號
                $.post("./api/chk_pw.php", user, (result) => {
                    console.log(result);
                    if (parseInt(result) === 1) {
                        // 帳密正確
                        if (user.acc === 'admin') {
                            // 管理者帳號
                            location.href = 'back.php';
                        } else {
                            // 一般會員
                            location.href = 'index.php';
                        }
                    } else {
                        // 密碼錯誤
                        alert("密碼錯誤");
                    }
                })
            } else {
                // 無帳號
                alert("查無帳號");
                reset();
            }
        });
    }
</script>