import type { route as routeFn } from 'ziggy-js';
import { Page } from '@inertiajs/ienrtia';
import { ComponentCustomProtperties} from 'vue';

interface PageProps {
    flash?: {
        success?: string
        error?:string
    }
}

declare module '@vue/runtime-core' {
    interface ComponentCustomProtperties {
        $page: Page<PageProps>
    }
}

declare global {
    const route: typeof routeFn;
}
