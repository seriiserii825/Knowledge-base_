<script setup lang="ts">
  interface Props {
    title?: string;
    count?: number;
    enabled?: boolean;
  }

  const { title = "Default title", count = 0, enabled = true } = defineProps<Props>();
</script>
