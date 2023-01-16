<fieldset style="border: none;">
    <legend>目前位置 : 首頁 >分類網誌 <span id="type"></span></legend>
    <div style="display: flex;">
        <fieldset style="width: 25%;">
            <legen>分類網誌</legen>
            <?php
            foreach ($News->type as $key => $type) {
            ?>
                <a href="#" data-type="<?= $key; ?>">
                    <p><?= $type; ?></p>
                </a>
            <?php
            }
            ?>
        </fieldset>
        <fieldset style="width: 75%;">
            <legen>文章列表</legen>
            <div class="type-lists">

            </div>
        </fieldset>
    </div>

    <script>
        $("p").on("click", function() {
            $('#type').text(">" + $(this).text());
            console.log($(this).parent().data("type"));
            getList($(this).parent().data("type"));
        })

        function getList(type) {
            $.get("./api/get_list.php", {
                type
            }, (list) => {
                $('.type-lists').html(list);
            })
        }

        function getNews(id){
            $.get("./api/get_news.php",{id},(news)=>{
                $('.type-lists').html(news);
            })
        }
    </script>