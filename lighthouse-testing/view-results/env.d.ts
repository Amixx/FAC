/// <reference types="vite/client" />

interface ImportMetaEnv {
  readonly VITE_APP_DIR:
    | 'content-platform'
    | 'shopping-platform'
    | 'productivity-tool'
    | 'entertainment-platform'
    | 'social-network'
}

interface ImportMeta {
  readonly env: ImportMetaEnv
}
