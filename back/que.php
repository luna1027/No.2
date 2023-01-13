<fieldset class="cent" style="width: 700px;">
    <legend>新增問券</legend>
    <form action="./api/add_que.php" method="post">
        <div class="subject">
            <div>
                <label class="clo" for="">問卷名稱</label>
                <input type="text" name="subject" style="width: 500px;">
            </div>
        </div>
        <div class="options clo">
            <div>
                <label for="">選項</label>
                <input type="text" name="option[]" style="width: 600px;">
            </div>
        </div>
        <div>
            <!-- <input type="hidden" name="table" value="User"> -->
            <input type="submit" value="新增">
            <input type="reset" value="清空">
            <input type="button" value="更多" onclick="more()">
        </div>
    </form>
</fieldset>

<script>
    function more() {
        let opt = ` <div>
                        <label for="">選項</label>
                        <input type="text" name="option[]" style="width: 600px;">
                    </div>`;

        $(".options").append(opt);
    }
</script>