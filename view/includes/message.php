<?php if (isset($_SESSION['error'])) { ?>
    <div id="message-container">
        <h3 class="error">
            <?= $_SESSION['error'] ?>
            <i id="message-close-btn" onclick="closeMessageContainer()" class="fa-solid fa-xmark"></i>
        </h3>
    </div>
<?php
    $_SESSION['error'] = null;
} ?>
<?php if (isset($_SESSION['success'])) { ?>
    <div id="message-container">
        <h3 class="success">
            <?= $_SESSION['success'] ?>
            <i id="message-close-btn" onclick="closeMessageContainer()" class="fa-solid fa-xmark"></i>
        </h3>
    </div>
<?php
    $_SESSION['success'] = null;
} ?>

<script>
    function closeMessageContainer() {
        document.getElementById('message-container').style.display = 'none';
    }
</script>