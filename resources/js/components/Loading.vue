<template>
    <div v-if="loading" class="loading-overlay">
        <div class="spinner"></div>
        <div class="loading-text">Cargando...</div>
    </div>
</template>

<script>
export default {
    props: {
        loading: {
            type: Boolean,
            default: false
        }
    }
}
</script>

<style scoped>
.loading-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;

    background: rgba(255, 255, 255, 0.75);

    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;

    z-index: 9999;
}

.spinner {
    width: 50px;
    height: 50px;

    border: 5px solid #ddd;
    border-top: 5px solid #3498db;

    border-radius: 50%;

    animation: girar 0.8s linear infinite;
}

.loading-text {
    margin-top: 15px;
    font-size: 16px;
    color: #555;
}

@keyframes girar {
    from {
        transform: rotate(0deg);
    }

    to {
        transform: rotate(360deg);
    }
}
</style>