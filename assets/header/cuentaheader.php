<div class="header">
        <div class="hinfo">
            <div class="profileimg">
                <?php
                echo '<img src="data:image/jpg;base64,'.$_SESSION["image"].' " class=>';
                ?>
                
            </div>
            <div class="names">
                <p><?php
                echo $_SESSION["name"];
                ?></p>
                <p><?php
                echo $_SESSION["username"];
            ?></p>
            </div>
        </div>
</div>