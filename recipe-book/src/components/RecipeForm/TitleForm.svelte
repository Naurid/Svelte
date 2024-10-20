<script>
    let title = '';
</script>

<h2>{title}</h2>
<input type="text"  bind:value={title} >

<style>
    h2{
        font-size: 3rem;
        font-family:system-ui, -apple-system, BlinkMacSystemFont, 'Segoe UI', Roboto, Oxygen, Ubuntu, Cantarell, 'Open Sans', 'Helvetica Neue', sans-serif;
        color: #f2c44f;
        width: 40%;
        height: 3rem;
    }

    input{
        width: 40%;
        height: 3rem;
        border-radius: 1rem;
    }
</style>