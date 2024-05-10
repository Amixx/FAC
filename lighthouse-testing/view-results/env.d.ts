/// <reference types="vite/client" />

interface ImportMetaEnv {
  readonly VITE_APP_DIR:
    | 'content-platform'
    | 'shopping-platform'
    | 'productivity-tool'
    | 'social-network'
}

interface ImportMeta {
  readonly env: ImportMetaEnv
}
