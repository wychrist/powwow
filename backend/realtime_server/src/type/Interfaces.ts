interface IApplication {
    id?: number,
    name: string,
    server: string,
    status: string
}

interface ValidationResult {
    success: boolean,
    message?: string
}