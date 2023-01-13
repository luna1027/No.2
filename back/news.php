<form action="./api/edit.php" method="post">
    <table class="ct" style="width: 800px;">
        <tr>
            <th class="ct" style="width: 8%;">編號</th>
            <th class="ct">標題</th>
            <th class="ct" style="width: 10%;">顯示</th>
            <th class="ct" style="width: 10%;">刪除</th>
        </tr>
        <?php
        $total = $News->count(1);
        // echo $total;
        $div = 3;
        $pages = ceil($total / $div);
        // echo $pages;
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;
        $rows = $News->all(' LIMIT ' . $start . "," . $div);
        foreach ($rows as $key => $row) {
            $checked = $row['sh'] == 1 ? 'checked' : '';
        ?>
            <tr>
                <td class="ct clo"><?= $key + 1; ?>.</td>
                <td class="ct"><?= $row['title']; ?></td>
                <td class="ct"><input type="checkbox" name="sh[]" value="<?= $row['id']; ?>" <?= $checked; ?>></td>
                <td class="ct"><input type="checkbox" name="del[]" value="<?= $row['id']; ?>"></td>
                <input type="hidden" name="id[]" value="<?= $row['id']; ?>">
            </tr>
        <?php
        }
        ?>
    </table>
    <div class="ct">
        <?php
        if ($now - 1 > 0) {
            $pre = $now - 1
        ?>
            <a href="back.php?do=news&p=<?= $pre; ?>"> &lt;</a>
        <?php
        }
        for ($i = 1; $i <= $pages; $i++) {
            $size = ($i == $now) ? '24px' : '16px';
        ?>
            <a href="back.php?do=news&p=<?= $i; ?>" style="font-size:<?= $size ?>"><?= $i; ?></a>
        <?php
        }
        if ($now + 1 <= $pages) {
            $next = $now + 1
        ?>
            <a href="back.php?do=news&p=<?= $next; ?>"> &gt;</a>
        <?php
        }
        ?>
    </div>
    <div class="ct">
        <input type="hidden" name="table" value="News">
        <input type="submit" value="確定修改">
    </div>
</form>