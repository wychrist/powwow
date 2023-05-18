import { EmbeddedValidationRule, EmbeddedValidationRuleFn } from 'quasar'

type EmailRule = Record<EmbeddedValidationRule, EmbeddedValidationRuleFn<'email'>>

/**
 * Validates an email
 *
 * This method uses quasar pattern rules
 *
 */
export function validateEmail (message = 'Email not valid'): (email: string, rules: EmailRule) => boolean | string {
  return (value: string, rules: EmailRule) => {
    return rules.email(value as 'email') || message
  }
}

/**
 * Validate that the value is not empty
 *
 */
export function validateNotEmpty (message = 'Field is required'): (value: unknown) => boolean | string {
  return (value: unknown) => {
    return !!value || message
  }
}
