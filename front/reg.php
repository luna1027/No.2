<fieldset class="cent" style="width: fit-content;">
    <legend>會員註冊</legend>
    <p style="color: red;">*請設定您要註冊的帳號及密碼(最長12個字元)</p>
    <table>
        <tr>
            <td style="width: 250px;background:#d9d9d9;">Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc" maxlength="12"></td>
        </tr>
        <tr>
            <td style="width: 150px;background:#d9d9d9;">Step2:登入密碼</td>
            <td><input type="password" name="pw" id="pw" maxlength="12"></td>
        </tr>
        <tr>
            <td style="width: 150px;background:#d9d9d9;">Step3:再次確認密碼</td>
            <td><input type="password" name="cfmpw" id="cfmpw" maxlength="12"></td>
        </tr>
        <tr>
            <td style="width: 150px;background:#d9d9d9;">Step4:信箱(忘記密碼時使用)</td>
            <td><input type="text" name="email" id="email"></td>
        </tr>
    </table>
    <div>
        <!-- <input type="hidden" name="table" value="User"> -->
        <button onclick="reg()">註冊</button>
        <button onclick="reset()">清除</button>
    </div>
</fieldset>

<script>
    // reset 功能
    function reset() {
        $("#acc,#pw,#cfmpw,#mail").val('');
    }

    function reg() {
        let reg = {
            acc: $("#acc").val(),
            pw: $("#pw").val(),
            cfmpw: $("#cfmpw").val(),
            email: $("#email").val()
        }

        if (reg.acc && reg.pw && reg.cfmpw && reg.email) {
            if (reg.cfmpw !== reg.pw) {
                alert("密碼錯誤");
            } else {
                $.post("./api/reg.php", reg, (result) => {
                    console.log(result);
                    if (parseInt(result) === 0) {
                        alert("註冊完成，歡迎加入");
                        location.href = 'index.php?do=login';
                    } else {
                        alert("帳號重複");
                    }
                })
            }
        } else {
            // $("input").each((i) => {
            //     console.log($("input").eq(i).val().length);
            //     if ($("input").eq(i).val().length < 1) {
            //         // console.log($("input").eq(i));
            alert("不可空白");
            //         return;
            //     }
            // })
        }



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