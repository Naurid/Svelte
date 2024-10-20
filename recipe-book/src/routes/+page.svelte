<script>
	import NavBar from "../components/NavBar.svelte";
	import TitleForm from "../components/RecipeForm/TitleForm.svelte";
</script>

<div class="mainBody">
<NavBar/>
<div class="formBody">
<TitleForm/>
</div>
</div>

<style>
    .mainBody{
        background-color: rgba(255, 230, 167, 0.735);
        height: 100vh;
        width: 100vw;
    }

    .formBody{
        display: flex;
        flex-direction: column;
        justify-content:flex-start;
        align-items: center;
        margin-top: 5rem;
        gap: 5%;
        height: 100%;
    }
</style>