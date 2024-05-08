type LighthouseAudit = {
  id: string
  title: string
  numericValue: number
  displayValue: string
}
type LighthouseOutput = {
  requestedUrl: string
  audits: {
    'first-contentful-paint': LighthouseAudit
    'largest-contentful-paint': LighthouseAudit
    'total-blocking-time': LighthouseAudit
    'cumulative-layout-shift': LighthouseAudit
    'speed-index': LighthouseAudit
    interactive: LighthouseAudit
  }
}
export type StructuredOutput = Array<
  [
    LighthouseOutput,
    LighthouseOutput,
    LighthouseOutput,
    LighthouseOutput,
    LighthouseOutput,
  ]
>
