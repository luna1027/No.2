    <fieldset>
        <legend>目前位置 : 首頁 >問卷調查 ><?= $Que->find(['id' => $_GET['id']])['text']; ?></legend>
        <table class="ct" style="margin:auto;width:750px;">
            <tr style="height: 40px;">
                <td class="l" colspan="3">
                    <h3><?= $Que->find(['id' => $_GET['id']])['text']; ?></h3>
                </td>
            </tr>
            <?php
            $rows = $Que->all(['parent' => $_GET['id']]);
            $all = $Que->find(['id' => $_GET['id']])['count'];
            $all = $all == 0 ? 1 : $all;
            foreach ($rows as $key => $row) {
                // echo $row['count'];
                // echo $all;
                $width = ($row['count'] / $all) * 100;
            ?>
                <tr style="height: 40px; width:100%;">
                    <td class="l" style="width: 5%"><?= $key + 1; ?>.</td>
                    <td class="l" style="width: 40%"><?= $row['text']; ?></td>
                    <td class="l" style="display:flex;align-items:center;">
                        <div style="background: #E0E0E0;width:<?= $width * 0.7; ?>%; height: 30px; border-left:1px solid #E0E0E0;"></div>
                        <div style=""><?= $row['count']; ?>票(<?= round($width, 1); ?>%)</div>
                    </td>
                </tr>
            <?php
            }
            ?>
        </table>
        <a href="?do=que"><button class="cent">返回</button></a>
    </fieldset>