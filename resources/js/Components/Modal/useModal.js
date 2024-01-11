import { reactive } from 'vue';

export const useModal = (fn) => {
    const state = reactive({
        visible: false,
        loading: false,
        payload: null,
    });

    const open = (payload) => {
        state.visible = true;
        state.payload = payload;
    };

    const close = () => {
        if (state.loading) return;

        state.visible = false;
        state.payload = null;
    };

    const confirm = async () => {
        if (state.loading) return;

        state.loading = true;

        try {
            await fn(state.payload);
        } catch (error) {
            throw error;
        } finally {
            state.loading = false;

            close();
        }
    };

    return {
        state,
        open,
        close,
        confirm,
    }
}
