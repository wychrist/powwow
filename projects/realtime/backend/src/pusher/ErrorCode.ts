export const ErrorCode = {

    /**
     * Application only accepts SSL connections
     */
    4000: { code: 4000, message: 'Application only accepts SSL connections' },
    
    /**
     * Application does not exist
     */
    4001: { code: 4001, message: 'Application does not exist' },

    /**'
     * Application disabled
     */
    4003: { code: 4003, message: 'Application disabled' },

    /**
     * Application is over connection quota
     */
    4004: { code: 4004, message: 'Application is over connection quota' },

    /**
     * Path not found
     */
    4005: { code: 4005, message: 'Path not found' },

    /**
     * Invalid version string format
     */
    4006: { code: 4006, message: 'Invalid version string format' },

    /**
     * Unsupported protocol version
     */
    4007: { code: 4007, messag: 'Unsupported protocol version' },

    /**
     * No protocol version supplied
     */
    4008: { code: 4008, message: 'No protocol version supplied' },

    /**
     * Connection is unauthorized
     */
    4009: { code: 4009, message: 'Connection is unauthorized' },

    /**
     * Over capacity
     */
    4100: { code: 4100, message: 'Over capacity' },

    /**
     * Generic reconnect immediately
     */
    4200: { code: 4200, message: 'Generic reconnect immediately' },

    /**
     * Pong reply not received
     */
    4201: { code: 4201, message: 'Pong reply not received' },

    /**
     * Closed after inactivity
     */
    4202: { code: 4202, message: 'Closed after inactivity' },

    /**
     * Client event rejected due to rate limit
     */
    4301: { code: 4301, message: 'Client event rejected due to rate limit' },
}
