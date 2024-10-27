<div class="navBody">
	<a href="/"><h1>New Recipe</h1></a>
	<a href="/recettes"><h1>All Recipes</h1></a>
</div>

<style>
	
	h1 {
		font-size: 2.5rem;
		font-family:
			system-ui,
			-apple-system,
			BlinkMacSystemFont,
			'Segoe UI',
			Roboto,
			Oxygen,
			Ubuntu,
			Cantarell,
			'Open Sans',
			'Helvetica Neue',
			sans-serif;
		color: var(--nav-text);
		margin-right: auto;
		padding-left: 25px;
		padding-right: 25px;
	}
	
	.navBody a{
		text-decoration: none;
	}
	.navBody a:hover h1{
		color: var(--nav-text-active);
	}

	.navBody {
		display: inline-flex;
		justify-content: center;
		align-items: center;
        position: fixed;
        top: 0;
        left: 0;
		background-color: var(--nav-bg);
		width: 100vw;
		height: 7%;
		z-index: 1;
		backdrop-filter: blur(5px);
		-webkit-backdrop-filter: blur(5px);
		box-shadow: 0 0 10px var(--nav-bg);
	}

</style>
