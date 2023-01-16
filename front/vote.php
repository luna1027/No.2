<fieldset>
    <legend>目前位置 : 首頁 >問卷調查 ><?= $Que->find(['id' => $_GET['id']])['text']; ?></legend>
    <form action="./api/vote.php" method="post">
        <table class="ct" style="margin:auto">
            <tr style="height: 40px;">
                <th class="l"><?= $Que->find(['id' => $_GET['id']])['text']; ?></th>
            </tr>
            <?php
            $rows = $Que->all(['parent' => $_GET['id']]);
            foreach ($rows as $row) {
            ?>
                <tr style="height: 40px;">
                    <td class="l"><input type="radio" name="id" value="<?= $row['id']; ?>" required><?= $row['text']; ?></td>
                </tr>
            <?php
            }
            ?>
        </table>
        <input type="hidden" name="subject_id" value="<?= $_GET['id']; ?>">
        <input type="hidden" name="table" value="Que">
        <input class="cent" type="submit" value="我要投票">
    </form>
</fieldset>