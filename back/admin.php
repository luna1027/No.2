<fieldset class="cent" style="width: fit-content;">
    <legend>帳號管理</legend>
    <form action="./api/del_acc.php" method="post">
        <table>
            <tr class="clo">
                <td class="ct" style="width:200px;">帳號</td>
                <td class="ct" style="width:200px;">密碼</td>
                <td class="ct" style="width:100px;">刪除</td>
            </tr>
            <?php
            $rows = $User->all();
            foreach ($rows as $row) {
                if ($row['acc'] !== 'admin') {
                    $pw = strlen($row['pw']);
            ?>
                    <tr>
                        <td class="ct"><?= $row['acc']; ?></td>
                        <td class="ct"><?= str_repeat('*', $pw); ?></td>
                        <td class="ct"><input class="del" type="checkbox" name="del[]" value="<?= $row['id']; ?>"></td>
                    </tr>
            <?php
                }
            }
            ?>
        </table>
        <div style="width: fit-content;margin:auto;">
            <input type="hidden" name="table" value="User">
            <input type="submit" value="確定刪除">
            <input type="reset" value="清空選取">
        </div>
    </form>
    <h2>新增會員</h2>
    <p style="color: red;">*請設定您要註冊的帳號及密碼(最長12個字元)</p>
    <table>
        <tr>
            <td class="clo" style="width: 250px;">Step1:登入帳號</td>
            <td><input type="text" name="acc" id="acc" maxlength="12"></td>
        </tr>
        <tr>
            <td class="clo" style="width: 150px;">Step2:登入密碼</td>
            <td><input type="password" name="pw" id="pw" maxlength="12"></td>
        </tr>
        <tr>
            <td  class="clo"style="width: 150px;">Step3:再次確認密碼</td>
            <td><input type="password" name="cfmpw" id="cfmpw" maxlength="12"></td>
        </tr>
        <tr>
            <td class="clo" style="width: 150px;">Step4:信箱(忘記密碼時使用)</td>
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
                        alert("新增會員成功");
                        location.href = 'back.php?do=admin';
                    } else {
                        alert("帳號重複");
                    }
                })
            }
        } else {
            alert("不可空白");
        }
    }
</script>