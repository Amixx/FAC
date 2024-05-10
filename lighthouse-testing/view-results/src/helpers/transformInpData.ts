export const transformInpData = (
  inpData: Partial<
    Record<
      'tSsr' | 'hda' | 'spa' | 'mSsr' | 'ssg',
      number | [number, number, number, number, number]
    >
  >,
) => {
  return Object.entries(inpData).reduce(
    (acc, [key, value]) => {
      if (typeof value === 'number') {
        const val = {
          numericValue: value,
          displayValue: `${value} ms`,
        }
        acc[key as keyof typeof acc] = new Array(5).fill(val)
      } else {
        acc[key as keyof typeof acc] = value.map((v) => {
          return { numericValue: v, displayValue: `${v} ms` }
        })
      }
      return acc
    },
    {} as Partial<
      Record<
        'tSsr' | 'hda' | 'spa' | 'mSsr' | 'ssg',
        Array<{ numericValue: number; displayValue: string }>
      >
    >,
  )
}
