<fieldset>
    <legend>目前位置 : 首頁 >最新文章區</legend>
    <table>
        <tr>
            <td style="width: 30%;">標題</td>
            <td style="width: 50%;">內容</td>
            <td></td>
        </tr>
        <?php
        $total = $News->count(['sh' => 1]);
        // echo $total;
        $div = 5;
        $pages = ceil($total / $div);
        // echo $pages;
        $now = $_GET['p'] ?? 1;
        $start = ($now - 1) * $div;
        $rows = $News->all(['sh' => 1], ' LIMIT ' . $start . "," . $div);
        foreach ($rows as $key => $row) {
            $checked = $row['sh'] == 1 ? 'checked' : '';
        ?>
            <tr>
                <td class="ct news-title"><?= $row['title']; ?></td>
                <td class="ct"><?= mb_substr($row['text'], 0, 20); ?></td>
                <td>
                    <?php
                    if (isset($_SESSION['login'])) {
                        if ($Log->count(['news' => $row['id'], 'acc' => $_SESSION['login']]) > 0) {
                    ?>
                            <a href="#" class="goods" data-user="<?= $_SESSION['login']; ?>" data-news="<?= $row['id']; ?>">收回讚</a>
                        <?php
                        } else {
                        ?>
                            <a href="#" class="goods" data-user="<?= $_SESSION['login']; ?>" data-news="<?= $row['id']; ?>">讚</a>
                    <?php
                        }
                    }
                    ?>
                </td>
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
            <a href="index.php?do=news&p=<?= $pre; ?>"> &lt;</a>
        <?php
        }
        for ($i = 1; $i <= $pages; $i++) {
            $size = ($i == $now) ? '24px' : '16px';
        ?>
            <a href="index.php?do=news&p=<?= $i; ?>" style="font-size:<?= $size ?>"><?= $i; ?></a>
        <?php
        }
        if ($now + 1 <= $pages) {
            $next = $now + 1
        ?>
            <a href="index.php?do=news&p=<?= $next; ?>"> &gt;</a>
        <?php
        }
        ?>
    </div>
</fieldset>