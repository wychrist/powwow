import { createHmac } from 'crypto'

export function generateRadom(): string {
    return createHmac('sha256', Math.random().toString(36).substr(2, 50))
        .digest('hex').toString()
}