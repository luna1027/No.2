<fieldset>
    <legend>目前位置 : 首頁 >問卷調查</legend>
    <table class="ct" style="width: 750px;">
        <tr style="height: 40px;">
            <th class="ct" style="width:5%;">編號</th>
            <th class="ct">問卷題目</th>
            <th class="ct" style="width:10%;">投票總數</th>
            <th class="ct" style="width:10%;">結果</th>
            <th class="ct" style="width:10%;">狀態</th>
        </tr>
        <?php
        $rows = $Que->all(['parent' => 0]);
        foreach ($rows as $key => $row) {
        ?>
            <tr style="height: 40px;">
                <td class="ct"><?= $key + 1; ?>.</td>
                <td class="l"><?= $row['text']; ?></td>
                <td class="ct"><?= $row['count']; ?></td>
                <td class="ct"><a href="?do=result&id=<?= $row['id']; ?>">結果</a></td>
                <?php
                if (isset($_SESSION['login'])) {
                ?>
                    <td class="ct"><a href="?do=vote&id=<?= $row['id']; ?>">參與投票</a></td>
                <?php
                } else {
                ?>
                    <td class="ct"><a href="?do=login">請先登入</a></td>
                <?php
                }
                ?>
            </tr>
        <?php
        }
        ?>
    </table>
</fieldset>