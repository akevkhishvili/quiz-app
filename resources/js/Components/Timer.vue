<script setup>
defineProps(['countDown']);
console.log(countDown);

</script>

<template>
    <span class="countdown font-mono text-6xl">{{ countDown }}</span>
</template>
