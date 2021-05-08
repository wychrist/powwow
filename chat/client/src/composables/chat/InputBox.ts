import { ref, SetupContext} from 'vue'

const message = ref<string>('')

let presses: { [key: string]: boolean } = {}

function resetKeyLog () {
      presses = {}
}
function onKeyDown (event: KeyboardEvent) {
  presses[event.key] = true;
}

function setupOnkeyUp(limit: number, ctx: SetupContext<string[]>): () => void {
    return function onKeyUp () {
      const enteredKey = 'Enter'
      const shiftKey = 'Shift';
      if (presses[enteredKey] && !presses[shiftKey]) {
        const messageToSend = message.value.trim()
        message.value = ''
        resetKeyLog()
        ctx.emit('updateValue', messageToSend)
      } else  {
        const msg = message.value.trim()
        if (msg.length > limit) {
          message.value = msg.substring(0, limit)
        }
        resetKeyLog()
      }
    }
}

export const emits = [
  'updateValue'
]

export function useInputBox(limit: number, ctx: SetupContext<string[]>) {
  return {
    refMessage: message,
    onKeyUp: setupOnkeyUp(limit, ctx),
    onKeyDown
  }
}
