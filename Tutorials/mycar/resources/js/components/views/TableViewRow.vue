<template>
<a :href="link">
    <div class="custom-table-row d-flex justify-content-between" :class="isSpecial">
        <div class="px-3">
            <div><small>{{topLeft}}</small></div>
            <div>{{bottomLeft}}</div>
        </div>
        <div class="text-right flex-shrink-0 px-3">
            <div><small>{{topRight}}</small></div>
            <div>{{bottomRight}}</div>
        </div>
    </div>
</a>
</template>

<script>
export default {
    props: ["topLeft", "bottomLeft", "topRight", "bottomRight", "special", "link"],
    computed: {
        isSpecial() {
            return this.special ? 'special' : '';
        }
    }
}
</script>
