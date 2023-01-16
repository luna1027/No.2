<fieldset>
    <legend>目前位置 : 首頁 >人氣文章區</legend>
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
        $rows = $News->all(['sh' => 1], " order by `good` desc LIMIT $start,$div");
        foreach ($rows as $key => $row) {
        ?>
            <tr>
                <td class="ct news-title"><?= $row['title']; ?></td>
                <td style="position: relative;" class="ct">
                    <div class="short"> <?= mb_substr($row['text'], 0, 20); ?>... </div>
                    <div class="full">
                        <div style="color: skyblue;"><?= $News->type[$row['type']]; ?></div>
                        <div style="color: white;"><?= nl2br($row['text']); ?></div>
                    </div>
                </td>
                <td>
                    <span class="num"><?= $Log->count(['news' => $row['id']]); ?></span>
                    個人說
                    <img src="./icons/02B03.jpg" style="width: 20px;height:20px;" alt="">
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
            <a href="index.php?do=pop&p=<?= $pre; ?>"> &lt;</a>
        <?php
        }
        for ($i = 1; $i <= $pages; $i++) {
            $size = ($i == $now) ? '24px' : '16px';
        ?>
            <a href="index.php?do=pop&p=<?= $i; ?>" style="font-size:<?= $size ?>"><?= $i; ?></a>
        <?php
        }
        if ($now + 1 <= $pages) {
            $next = $now + 1
        ?>
            <a href="index.php?do=pop&p=<?= $next; ?>"> &gt;</a>
        <?php
        }
        ?>
    </div>
</fieldset>

<script>
    $(".news-title").hover(
        function() {
            $(this).next().children('.full').show()
        },
        function() {
            $(this).next().children('.full').hide()
        }
    )

    $(".full").hover(
        function() {
            $(this).show();
        },
        function() {
            $(this).hide();
        }
    )
    // goodEvent('pop');
</script>