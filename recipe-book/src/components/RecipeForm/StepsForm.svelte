<script>

    export let title ='';
    export let content ='';
    
</script>

<div class="container">
	<div class="subContainer">
		<p>Step title</p>
		<input type="text" class="stepTitle" bind:value={title}/>
	</div>
	<div class="contentContainer">
		<p>Step content</p>
		<input type="text" class="stepContent" bind:value={content}/>
	</div>
</div>

<style>
	.container {
		display: flex;
		flex-direction: column;
		justify-content: center;
		align-items: center;
		gap: 1rem;
		width: 100%;
	}

    .subContainer{
        display: flex;
        flex-direction: column;
        width: 100%;
    }

    .contentContainer{
        display: flex;
        flex-direction: column;
        width: 100%;
    }


	.subContainer input {
		width: 80%;
		height: 3rem;
		border-radius: 1rem;
		padding-left: 1rem;
	}
    
	.contentContainer input {
		width: 80%;
		height: 6rem;
		border-radius: 1rem;
		padding-left: 1rem;
	}

    p {
		text-align: start;
        font-family: system-ui,
			-apple-system,
			BlinkMacSystemFont,
			'Segoe UI',
			Roboto,
			Oxygen,
			Ubuntu,
			Cantarell,
			'Open Sans',
			'Helvetica Neue',
			sans-serif;;
		margin: 0;
	}
</style>
