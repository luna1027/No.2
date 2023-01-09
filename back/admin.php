<fieldset class="cent" style="width: fit-content;">
    <legend>帳號管理</legend>
    <form action="./api/edit.php" method="post">

        <table>
            <tr>
                <td class="ct" style="width:200px; background:#d9d9d9;">帳號</td>
                <td class="ct" style="width:200px; background:#d9d9d9;">密碼</td>
                <td class="ct" style="width:100px; background:#d9d9d9;">刪除</td>
            </tr>
            <?php
            $rows = $User->all();
            foreach ($rows as $row) {
                if ($row['acc'] == 'admin') {
                    continue;
                } else {
                    $pw = strlen($row['pw']);
            ?>
                    <tr>
                        <td class="ct"><?= $row['acc']; ?></td>
                        <td class="ct"><?= str_repeat('*', $pw); ?></td>
                        <td class="ct"><input type="checkbox" name="del[]" value="<?= $row['id']; ?>"></td>
                        <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
                    </tr>
            <?php
                }
            }
            ?>
        </table>
        <div style="width: fit-content;margin:auto;">
            <input type="hidden" name="table" value="User">
            <button onclick="">確定刪除</button>
            <button onclick="reset()">清空選取</button>
        </div>
    </form>
</fieldset>

<script>
    function reset() {
        $(".del").reset();
    }
</script>